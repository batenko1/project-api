<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Page\StoreRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!Gate::allows('index page')) abort(404);

        $pages = Page::query()->orderBy('id', 'desc')->get();

        if($request->expectsJson()) {
            return response()->json($pages);
        }

        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('create page')) abort(404);

        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        if (!Gate::allows('store page')) abort(404);

        $data = $request->validated();
        $data['slug'] = \Str::slug($data['title']);

        $page = Page::query()->create($data);


        if($request->expectsJson()) {
            return response()->json($page, 201);
        }

        if($request->submit_and_reload) {
            return redirect()->route('admin.pages.edit', $page->id)->with('message', 'Успешно создано');
        }

        return redirect()->route('admin.pages.index')->with('message', 'Успешно сохранено');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        if (!Gate::allows('show page')) abort(404);

        return response()->json($page);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {

        if (!Gate::allows('edit page')) abort(404);

        return view('pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Page $page)
    {
        if (!Gate::allows('update page')) abort(404);

        $data = $request->validated();
        $data['slug'] = \Str::slug($data['title']);

        $page->update($data);


        if($request->expectsJson()) {
            return response()->json($page, 201);
        }

        if($request->submit_and_reload) {
            return redirect()->route('admin.pages.edit', $page->id)->with('message', 'Успешно создано');
        }

        return redirect()->route('admin.pages.index')->with('message', 'Успешно сохранено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Page $page)
    {

        if (!Gate::allows('delete page')) abort(404);

        $page->delete();

        if($request->expectsJson()) {
            return response(null, 204);
        }

        return redirect()->route('admin.pages.index')->with('message', 'Успешно удалено');
    }
}
