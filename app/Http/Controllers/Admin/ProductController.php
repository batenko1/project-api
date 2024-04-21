<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\StoreRequest;
use App\Models\Entity;
use App\Models\Filter;
use App\Models\Product;
use App\Services\StoreFilterProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            ->when(count($data), function ($query) use ($data) {

                foreach ($data as $key => $value) {

                    $filterId = \Str::replace('filter_', '', $key);


                    if (strpos($key, 'filter') !== false) {
                        $query->whereHas('values', function ($query) use ($value, $filterId) {

                            if(is_array($value)) {
                                $query->whereIn('value', $value)
                                    ->where('filter_id', $filterId);
                            }
                            else {
                                $query->where('value', $value)
                                    ->where('filter_id', $filterId);
                            }

                        });
                    }
                }

            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->each(function ($product) {
                $product->entity_name = $product->entity->title;
            });

        if ($request->expectsJson()) {
            return response()->json($products);
        }

        return view('products.index', compact('products'));

//        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function create()
    {

        $entities = Entity::all();

        return view('products.create', compact('entities'));
    }

    public function store(StoreRequest $request)
    {
        if (!Gate::allows('store product')) abort(404);

        DB::beginTransaction();

        try {

            $product = Product::query()->create($request->validated());

            StoreFilterProduct::save($product, $request);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }


        if ($request->expectsJson()) {
            return response()->json($product, 201);
        }

        if($request->submit_and_reload) {
            return redirect()->route('admin.products.edit', $product->id)->with('message', 'Успешно создано');
        }

        return redirect()->route('admin.products.index')->with('message', 'Успешно создано');

    }

    public function edit(Product $product)
    {

        $entities = Entity::all();

        $listEntities = $this->triesEntities($product->entity);

        $filters = Filter::query()->whereIn('entity_id', $listEntities)->get();


        $html = view('filters.template', compact('filters', 'product'))->render();

        return view('products.edit', compact('product', 'entities', 'html'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Product $product)
    {

        if (!Gate::allows('show product')) abort(404);

        if ($request->expectsJson()) {
            return response()->json($product);
        }

        return view('products.show', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Product $product)
    {
        if (!Gate::allows('update product')) abort(404);

        DB::beginTransaction();

        try {
            $product->update($request->validated());

            StoreFilterProduct::save($product, $request);


            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }


        if ($request->expectsJson()) {
            return response()->json($product, 201);
        }

        if($request->submit_and_reload) {
            return redirect()->route('admin.products.edit', $product->id)->with('message', 'Успешно обновлено');
        }

        return redirect()->route('admin.products.index')->with('message', 'Успешно обновлено');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {

        if (!Gate::allows('delete product')) abort(404);

        $product->delete();

        foreach ($product->values as $value) {
            if($value->filter->type == 'input_file') {
                Storage::disk('public')->delete($value->value);
            }
        }

        if ($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('admin.products.index')->with('message', 'Успешно удалено');
    }

    public function getFilters(Request $request, $entityId)
    {

        $entity = Entity::query()->findOrFail($entityId);

        $entities = $this->triesEntities($entity);

        $filters = Filter::query()->whereIn('entity_id', $entities)->where('is_entity', 0)->get();

        if ($request->ajax()) {
            $html = view('filters.template', compact('filters'))->render();

            return $html;
        }

        return response()->json($filters);

    }

    public function triesEntities($entity, &$parents = [])
    {

        $parents[] = $entity->id;
        if ($entity->parent_id) {
            $parentEntity = Entity::find($entity->parent_id);
            $this->triesEntities($parentEntity, $parents);
        }

        // Возвращаем массив родительских категорий
        return $parents;

    }

    public function getEloquentSqlWithBindings($query): string
    {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())
            ->map(function ($binding) {
                return is_numeric($binding) ? $binding : "'{$binding}'";
            })->toArray());
    }
}
