<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Entity\StoreRequest;
use App\Models\Entity;
use App\Services\StoreFilters;
use App\Traits\RoleControlTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

        $entity = Entity::query()->create($request->validated());

        if($request->get('filter_type')) {
            StoreFilters::save($entity, $request);
        }

        $this->storePermissions('entity '.$entity->id);

        if($request->expectsJson()) {
            return response()->json($entity, 201);
        }

        return redirect()->route('admin.entities.index')->with('message', 'Success');



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

        return view('entities.edit', compact('entity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Entity $entity)
    {

        if (!Gate::allows('update entity')) abort(404);

        $entity->update($request->validated());

        if($request->get('filters')) {
            StoreFilters::save($entity, $request->get('filters'));
        }

        $this->storePermissions('entity '.$entity->id);

        if($request->expectsJson()) {
            return response()->json($entity, 201);
        }

        return redirect()->route('admin.entities.index')->with('message', 'Success');

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

        return redirect()->back()->with('message', 'Success');

    }

}
