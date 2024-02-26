<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Entity\StoreRequest;
use App\Models\Entity;
use App\Services\StoreFilters;
use App\Traits\RoleControlTrait;

class EntityController extends Controller
{

    use RoleControlTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $entities = Entity::all();

        return view('entities.index', compact('entities'));

//        return response()->json($entities);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $entity = Entity::query()->create($request->validated());

        StoreFilters::save($entity, $request->get('filters'));

        $this->storePermissions('entity '.$entity->id);

        return response()->json($entity, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Entity $entity)
    {
        return response()->json($entity);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Entity $entity)
    {
        $entity->update($request->validated());

        StoreFilters::save($entity, $request->get('filters'));

        $this->storePermissions('entity '.$entity->id);

        return response()->json($entity, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entity $entity)
    {
        $entity->delete();

        return response()->json('Success delete', 204);
    }

}
