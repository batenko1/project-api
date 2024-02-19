<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Setting\StoreRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();

        return response()->json($settings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $setting = Setting::query()->create($request->validated());

        return response()->json($setting, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return response()->json($setting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Setting $setting)
    {
        $setting->update($request->validated());

        return response()->json($setting, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return response()->json(null, 204);
    }
}
