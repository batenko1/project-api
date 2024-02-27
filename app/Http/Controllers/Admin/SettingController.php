<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Setting\StoreRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!Gate::allows('index setting')) abort(404);

        $settings = Setting::query()->orderBy('id', 'desc')->get();

        if($request->expectsJson()) {
            return response()->json($settings);
        }

        return view('settings.index', compact('settings'));

    }

    public function create() {

        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        if (!Gate::allows('store setting')) abort(404);

        $setting = Setting::query()->create($request->validated());

        if($request->expectsJson()) {
            return response()->json($setting, 201);
        }

        return redirect()->route('admin.settings.index')->with('message', 'Success');

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Setting $setting)
    {

        if (!Gate::allows('show setting')) abort(404);

        if($request->expectsJson()) {
            return response()->json($setting);
        }

    }

    public function edit(Setting $setting) {

        return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Setting $setting)
    {
        if (!Gate::allows('update setting')) abort(404);

        $setting->update($request->validated());

        if($request->expectsJson()) {
            return response()->json($setting, 201);
        }

        return redirect()->route('admin.settings.index')->with('message', 'Success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Setting $setting)
    {
        if (!Gate::allows('delete setting')) abort(404);

        $setting->delete();

        if($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->back()->with('message', 'Success');
    }
}
