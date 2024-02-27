<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Role\StoreRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!Gate::allows('index role')) abort(404);

        $roles = Role::query()
            ->with('permissions')
            ->get();

        if($request->expectsJson()) {
            return response()->json($roles);
        }

        return view('roles.index', compact('roles'));

    }

    public function create() {

        if (!Gate::allows('create role')) abort(404);

        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        if (!Gate::allows('store role')) abort(404);

        $role = Role::query()->create([
            'name' => $request->get('name'),
        ]);

        foreach ($request->selectedPermissions as $permission) {
            $permissionModel = Permission::findById($permission);
            $role->givePermissionTo($permissionModel);
        }

        if($request->expectsJson()) {
            return response()->json('Success', 201);
        }

        return redirect()->back()->with('message', 'Success');

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Role $role)
    {

        if (!Gate::allows('show role')) abort(404);

        if($request->expectsJson()) {
            return response()->json($role);
        }

        return view('roles.show', compact('role'));

    }

    public function edit(Role $role) {

        if (!Gate::allows('edit role')) abort(404);

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Role $role)
    {
        if (!Gate::allows('update role')) abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Role $role)
    {
        if (!Gate::allows('delete role')) abort(404);

        $role->delete();

        if($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->back()->with('message', 'Success');

    }
}
