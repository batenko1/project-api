<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Setting\StoreRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $settings = Setting::all();

        if($request->expectsJson()) {
            return response()->json($settings);
        }

        return view('settings.index', compact('settings'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $setting = Setting::query()->create($request->validated());

        if($request->expectsJson()) {
            return response()->json($setting, 201);
        }

        return redirect()->back()->with('message', 'Success');

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Setting $setting)
    {

        if($request->expectsJson()) {
            return response()->json($setting);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Setting $setting)
    {
        $setting->update($request->validated());

        if($request->expectsJson()) {
            return response()->json($setting, 201);
        }

        return redirect()->back()->with('message', 'Success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Setting $setting)
    {
        $setting->delete();

        if($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->back()->with('message', 'Success');
    }
}
