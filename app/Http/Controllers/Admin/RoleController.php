<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::query()
            ->with('permissions')
            ->get();

        if($request->expectsJson()) {
            return response()->json($roles);
        }

        return view('roles.index', compact('roles'));

    }

    public function create() {

        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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

        if($request->expectsJson()) {
            return response()->json($role);
        }

        return view('roles.show', compact('role'));

    }

    public function edit(Role $role) {

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Role $role)
    {
        $role->delete();

        if($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->back()->with('message', 'Success');

    }
}
