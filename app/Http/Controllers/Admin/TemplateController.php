<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Template\StoreRequest;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!Gate::allows('index template')) abort(404);

        $templates = Template::all();

        if($request->expectsJson()) {
            return response()->json($templates);
        }

        return view('templates.index', compact('templates'));


    }

    public function create() {

        if (!Gate::allows('create template')) abort(404);

        return view('templates.create');

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
        $filePath = $file->store('public/templates');

        $template = new Template();
        $template->title = $data['title'];
        $template->variables = $data['variables'];

        if($file) {
            $template->file = \Str::replace('public/', '', $filePath);
        }

        $template->save();


        if($request->expectsJson()) {
            return response()->json($template, 201);
        }

        if($request->submit_and_reload) {
            return redirect()->route('admin.templates.edit', $template->id)->with('message', 'Успешно создано');
        }


        return redirect()->route('admin.templates.index')->with('message', 'Успешно сохранено');

    }

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        if (!Gate::allows('show template')) abort(404);

        return response()->json($template);
    }

    public function edit(Request $request, Template $template) {

        return view('templates.edit', compact('template'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Template $template)
    {
        if (!Gate::allows('update template')) abort(404);

        $data = $request->validated();


        $template->title = $data['title'];
        $template->variables = $data['variables'];

        if(isset($data['file'])) {
            $file = $data['file'];

            // Сохранение файла на сервере
            $filePath = $file->store('public/templates');



            if($file) {
                $template->file = \Str::replace('public/', '', $filePath);
            }
        }


        $template->save();

        if($request->expectsJson()) {
            return response()->json($template, 201);
        }

        if($request->submit_and_reload) {
            return redirect()->route('admin.templates.edit', $template->id)->with('message', 'Успешно создано');
        }

        return redirect()->route('admin.templates.index')->with('message', 'Успешно обновлено');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Template $template)
    {

        if (!Gate::allows('delete template')) abort(404);

        $template->delete();

        Storage::disk('public')->delete($template->file);

        if($request->expectsJson()) {
            return response(null, 204);
        }

        return redirect()->route('admin.templates.index')->with('message', 'Успешно удалено');

    }
}
