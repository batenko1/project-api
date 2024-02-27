<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\StoreRequest;
use App\Models\Entity;
use App\Models\Filter;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!Gate::allows('index product')) abort(404);

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

        if($request->expectsJson()) {
            return response()->json($products);
        }

        return view('products.index', compact('products'));

//        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        if (!Gate::allows('store order')) abort(404);

        $product = Product::query()->create($request->validated());

        $product->values()->sync($request->filter_values);

        if($request->expectsJson()) {
            return response()->json($product, 201);
        }

        return redirect()->back()->with('message', 'Success');

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Product $product)
    {

        if (!Gate::allows('show order')) abort(404);

        if($request->expectsJson()) {
            return response()->json($product);
        }

        return view('products.show', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Product $product)
    {
        if (!Gate::allows('update order')) abort(404);

        $product->update($request->validated());

        $product->values()->sync($request->filter_values);

        if($request->expectsJson()) {
            return response()->json($product, 201);
        }

        return redirect()->back()->with('message', 'Success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {

        if (!Gate::allows('delete order')) abort(404);

        $product->delete();

        if($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->back()->with('message', 'Success');
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
