<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Template\StoreRequest;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $templates = Template::all();

        if($request->expectsJson()) {
            return response()->json($templates);
        }

        return view('templates.index', compact('templates'));

//        return response()->json($templates);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

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
        return response()->json($template);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Template $template)
    {
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
        $template->delete();

        if($request->expectsJson()) {
            return response(null, 204);
        }

        return redirect()->back()->with('message', 'Success');

    }
}
