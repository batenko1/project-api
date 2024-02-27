<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Api\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController {


    public function index(Request $request) {
        $users = User::all();


        if ($request->expectsJson()) {
            return response()->json($users);
        }

        return view('users.index', compact('users'));
    }

    public function create() {

        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(StoreRequest $request) {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $role = Role::findById($request->role_id);

        $user->assignRole($role);

        if($request->expectsJson()) {
            return response()->json($user, 201);
        }

        return redirect()->route('admin.users.index')->with('message', 'Success');

    }

    public function show(Request $request, User $user) {

        return response()->json($user);
    }

    public function edit(User $user) {

        $roles = Role::all();

        return view('users.edit', compact('roles', 'user'));
    }

    public function update(Request $request, User $user) {

    }

    public function destroy(Request $request, User $user) {

        $user->delete();

        if($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->back()->with('message', 'Success');


    }

    public function getUser(Request $request)
    {

        $user = Auth::user();

        // Проверка, успешно ли прошла аутентификация
        if ($user) {
            // Если аутентификация успешна, возвращаем пользователя
            return response()->json(['user' => $user], 200);
        } else {
            // Если аутентификация не удалась, возвращаем ошибку "Unauthorized"
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
