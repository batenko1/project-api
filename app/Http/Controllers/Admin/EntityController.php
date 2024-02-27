<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Entity\StoreRequest;
use App\Models\Entity;
use App\Services\StoreFilters;
use App\Traits\RoleControlTrait;
use Illuminate\Http\Request;

class EntityController extends Controller
{

    use RoleControlTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $entities = Entity::all();

        if($request->expectsJson()) {
            return response()->json($entities);
        }

        return view('entities.index', compact('entities'));


    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $entity = Entity::query()->create($request->validated());

        StoreFilters::save($entity, $request->get('filters'));

        $this->storePermissions('entity '.$entity->id);

        if($request->expectsJson()) {
            return response()->json($entity, 201);
        }

        return redirect()->back()->with('message', 'Success');



    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Entity $entity)
    {

        if($request->expectsJson()) {
            return response()->json($entity);
        }

        return view('entities.show', compact('entity'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Entity $entity)
    {
        $entity->update($request->validated());

        StoreFilters::save($entity, $request->get('filters'));

        $this->storePermissions('entity '.$entity->id);

        if($request->expectsJson()) {
            return response()->json($entity, 201);
        }

        return redirect()->back('entities')->with('message', 'Success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Entity $entity)
    {
        $entity->delete();

        if($request->expectsJson()) {
            return response()->json('Success delete', 204);
        }

        return redirect()->back()->with('message', 'Success');

    }

}
