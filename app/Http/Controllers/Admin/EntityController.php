<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Entity\StoreRequest;
use App\Models\Entity;
use App\Models\Filter;
use App\Models\FilterValue;
use App\Services\StoreFilterProduct;
use App\Services\StoreFilters;
use App\Traits\RoleControlTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EntityController extends Controller
{

    use RoleControlTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        if (!Gate::allows('index entity') && !str_contains($request->path(), 'api')) abort(404);

        $data = $request->all();

        $entities = Entity::query()
            ->with(['values', 'fields'])
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
            ->whereNull('parent_id')
            ->orderBy('id', 'desc')
            ->get();

        if($request->expectsJson()) {
            return response()->json($entities);
        }

        return view('entities.index', compact('entities'));

    }

    public function create() {

        $entities = Entity::query()->get();


        return view('entities.create', compact('entities'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        if (!Gate::allows('store entity')) abort(404);

        DB::beginTransaction();

        try {
            $entity = Entity::query()->create($request->validated());

            if($request->get('filter_type')) {
                StoreFilters::save($entity, $request);
            }

            if($request->get('filter_entity_type')) {
                StoreFilters::saveEntity($entity, $request);
            }

            $this->storePermissions('entity '.$entity->id);

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }


        if($request->expectsJson()) {
            return response()->json($entity, 201);
        }

        if($request->submit_and_reload) {
            return redirect()->route('admin.entities.edit', $entity->id)->with('message', 'Успешно сохранено');
        }

        return redirect()->route('admin.entities.index')->with('message', 'Успешно сохранено');



    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Entity $entity)
    {

        if (!Gate::allows('show entity')) abort(404);

        if($request->expectsJson()) {
            return response()->json($entity);
        }

        return view('entities.show', compact('entity'));

    }

    public function edit(Entity $entity) {

        $listEntities = Entity::query()
            ->where('id', '!=', $entity->id)
            ->get();

        $filters = Filter::query()->where('entity_id', $entity->id)->where('is_entity', 1)->get();
        $name = 'entity_';

        $html = view('filters.template', [
            'filters' => $filters,
            'name' => $name,
            'product' => $entity
        ])->render();

        return view('entities.edit', compact('entity', 'listEntities', 'html'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Entity $entity)
    {

        if (!Gate::allows('update entity')) abort(404);

        DB::beginTransaction();

        try {
            $entity->update($request->validated());

            if($request->get('filter_delete')) {
                $filterDelete = $request->get('filter_delete');
                $filterDelete = explode(',', $filterDelete);

                foreach ($filterDelete as $item) {
                    if($item) {
                        $filter = Filter::query()->where('id', $item)->first();

                        if($filter->type == 'input_file') {
                            $filterValues = $entity->values->where('filter_id', $filter->id)->first();


                            foreach (json_decode($filterValues->value) as $filterValue) {
                                Storage::disk('public')->delete($filterValue);
                            }
                        }

                        $filter->delete();

                    }
                }
            }


            if($request->get('filter_type')) {
                StoreFilters::save($entity, $request);
            }
            else {
                if($request->get('filter_name')) {
                    foreach ($request->get('filter_name') as $key => $filterName) {

                        $filter = Filter::query()->where('id', $key)->first();

                        Filter::query()->where('id', $key)->update([
                            'title' => $filterName,
                            'alias' => isset($request->get('filter_alias')[$key]) ? $request->get('filter_alias')[$key] : ''
                        ]);

//                        if($filter->type == 'input_file') {
//                            $filterValues = $filter->values;
//
//                            foreach ($filterValues as $filterValue) {
//                                Storage::disk('public')->delete($filterValue);
//                            }
//                        }

                        if($filter->type == 'select') {
                            $values = $request->filter_values[$key];
                            $values = explode(',', $values);

                            $filter->values()->delete();

                            foreach ($values as $value) {
                                $newFilterValue = new FilterValue();
                                $newFilterValue->filter_id = $filter->id;
                                $newFilterValue->value = $value;
                                $newFilterValue->save();
                            }
                        }


                    }
                }

            }

            if($request->get('filter_entity_type')) {
                StoreFilters::saveEntity($entity, $request);
            }
            else {
                if($request->get('filter_entity_name')) {


                    foreach ($request->get('filter_entity_name') as $key => $filterName) {
                        $filter = Filter::query()->where('id', $key)->first();

                        $data = [
                            'title' => $filterName,
                            'alias' => isset($request->get('filter_entity_alias')[$key]) ? $request->get('filter_entity_alias')[$key] : ''
                        ];

                        if($filter) {
                            Filter::query()->where('id', $key)->update($data);
                        }

                    }
                }
            }


            StoreFilterProduct::saveEntity($entity, $request);


            $this->storePermissions('entity '.$entity->id);

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            dd($e, $e->getLine());
        }

        if($request->expectsJson()) {
            return response()->json($entity, 201);
        }

        if($request->submit_and_reload) {
            return redirect()->route('admin.entities.edit', $entity->id)->with('message', 'Успешно обновлено');
        }

        return redirect()->route('admin.entities.index')->with('message', 'Успешно обновлено');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Entity $entity)
    {
        if (!Gate::allows('delete entity')) abort(404);

        $entity->delete();

        if($request->expectsJson()) {
            return response()->json('Success delete', 204);
        }

        return redirect()->route('admin.entities.index')->with('message', 'Успешно удалено');

    }

}
