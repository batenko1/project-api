<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Template\StoreRequest;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Gate::allows('index setting')) abort(404);

        $templates = Template::all();

        if($request->expectsJson()) {
            return response()->json($templates);
        }

        return view('templates.index', compact('templates'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        if (!Gate::allows('store template')) abort(404);

        $data = $request->validated();

        $file = $data['file'];

        // Сохранение файла на сервере
        $filePath = $file->store('templates');

        $template = Template::query()->create([
            'title' => $data['title'],
            'file' => $filePath,
            'variables' => $data['variables']
        ]);

        if($request->expectsJson()) {
            return response()->json($template, 201);
        }


        return redirect()->back()->with('message', 'Success');

    }

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        if (!Gate::allows('show template')) abort(404);

        return response()->json($template);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Template $template)
    {
        if (!Gate::allows('update template')) abort(404);

        $data = $request->validated();

        $file = $data['file'];

        // Сохранение файла на сервере
        $filePath = $file->store('templates');

        $template->update([
            'title' => $data['title'],
            'file' => $filePath,
            'variables' => $data['variables']
        ]);

        if($request->expectsJson()) {
            return response()->json($template, 201);
        }

        return redirect()->back()->with('message', 'Success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Template $template)
    {

        if (!Gate::allows('delete template')) abort(404);

        $template->delete();

        if($request->expectsJson()) {
            return response(null, 204);
        }

        return redirect()->back()->with('message', 'Success');

    }
}
