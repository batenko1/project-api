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
            ->orderBy('id', 'desc')
            ->get();

        if($request->expectsJson()) {
            return response()->json($roles);
        }

        return view('roles.index', compact('roles'));

    }

    public function create() {

        if (!Gate::allows('create role')) abort(404);

        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
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

        foreach ($request->permissions as $permission) {
            $permissionModel = Permission::findById($permission);
            $role->givePermissionTo($permissionModel);
        }

        if($request->expectsJson()) {
            return response()->json('Success', 201);
        }

        if($request->submit_and_reload) {
            return redirect()->route('admin.roles.edit', $role->id)->with('message', 'Успешно создано');
        }

        return redirect()->route('admin.roles.index')->with('message', 'Успешно создано');

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

        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Role $role)
    {
        if (!Gate::allows('update role')) abort(404);

        $role->name = $request->get('name');
        $role->save();

        $role->syncPermissions([]);

        foreach ($request->permissions as $permission) {
            $permissionModel = Permission::findById($permission);
            $role->givePermissionTo($permissionModel);
        }

        if($request->expectsJson()) {
            return response()->json('Success', 201);
        }

        if($request->submit_and_reload) {
            return redirect()->route('admin.roles.edit', $role->id)->with('message', 'Успешно обновлено');
        }

        return redirect()->route('admin.roles.index')->with('message', 'Успешно обновлено');
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

        return redirect()->route('admin.roles.index')->with('message', 'Успешно удалено');

    }
}
