<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Entity\StoreRequest;
use App\Models\Entity;
use App\Models\Filter;
use App\Services\StoreFilters;
use App\Traits\RoleControlTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class EntityController extends Controller
{

    use RoleControlTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!Gate::allows('index entity')) abort(404);

        $entities = Entity::query()
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

        return view('entities.edit', compact('entity', 'listEntities'));
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
                        Filter::query()->where('id', $item)->delete();
                    }
                }
            }


            if($request->get('filter_type')) {
                StoreFilters::save($entity, $request);
            }
            else {
                foreach ($request->get('filter_name') as $key => $filterName) {
                    Filter::query()->where('id', $key)->update([
                        'title' => $filterName
                    ]);
                }
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
