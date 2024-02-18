<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Entity\StoreRequest;
use App\Models\Entity;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $entities = Entity::all();

        return response()->json($entities);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $entity = Entity::query()->create($request->validated());

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
