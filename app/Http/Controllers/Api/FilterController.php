<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Filter\StoreRequest;
use App\Models\Filter;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = Filter::all();

        return response()->json($filters);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $filter = Filter::query()->create($request->validated());

        return response()->json($filter, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Filter $filter)
    {
        return response()->json($filter);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Filter $filter)
    {
        $filter->update($request->validated());

        return response()->json($filter, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filter $filter)
    {
        $filter->delete();

        return response()->json(null, 204);
    }

    public function types()
    {
        return response()->json(Filter::FIELDS);
    }
}
