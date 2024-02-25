<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\StoreRequest;
use App\Models\Entity;
use App\Models\Filter;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $products = Product::query()
            ->when(count($data), function ($query) use($data) {

                foreach ($data as $key => $value) {

                    $filterId = \Str::replace('filter_', '', $key);

                    if(strpos($key, 'filter') !== false) {
                        $query->whereHas('values', function ($query) use($value, $filterId) {
                            $query->where('value', $value)->where('filter_id', $filterId);
                        });
                    }
                }

            })
            ->get()->each(function ($product) {
                $product->entity_name = $product->entity->title;
            });

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $product = Product::query()->create($request->validated());

        $product->values()->sync($request->filter_values);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Product $product)
    {
        $product->update($request->validated());

        $product->values()->sync($request->filter_values);

        return response()->json($product, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }

    public function getFilters($entityId) {

        $entity = Entity::query()->findOrFail($entityId);

        $entities = $this->triesEntities($entity);

        $filters = Filter::query()->whereIn('entity_id', $entities)->get();

        return response()->json($filters);

    }

    public function triesEntities($entity, &$parents = []) {

        $parents[] = $entity->id;
        if ($entity->parent_id) {
            $parentEntity = Entity::find($entity->parent_id);
            $this->triesEntities($parentEntity, $parents);
        }

        // Возвращаем массив родительских категорий
        return $parents;

    }
}
