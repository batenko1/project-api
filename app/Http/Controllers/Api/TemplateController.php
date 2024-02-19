<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Template\StoreRequest;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = Template::all();

        return response()->json($templates);
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

        return response()->json($template, 201);
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

        return response()->json($template, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        $template->delete();

        return response(null, 204);
    }
}
