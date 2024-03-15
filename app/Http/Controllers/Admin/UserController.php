<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Api\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;

class UserController
{


    public function index(Request $request)
    {

        if (!Gate::allows('index user')) abort(404);

        $users = User::all();


        if ($request->expectsJson()) {
            return response()->json($users);
        }

        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (!Gate::allows('create user')) abort(404);

        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(StoreRequest $request)
    {

        if (!Gate::allows('store user')) abort(404);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $role = Role::findById($request->role_id);

        $user->assignRole($role);

        if ($request->expectsJson()) {
            return response()->json($user, 201);
        }

        if($request->submit_and_reload) {
            return redirect()->route('admin.users.edit', $user->id)->with('message', 'Успешно создано');
        }

        return redirect()->route('admin.users.index')->with('message', 'Успешно создано');

    }

    public function show(Request $request, User $user)
    {
        if (!Gate::allows('show user')) abort(404);

        return response()->json($user);
    }

    public function edit(User $user)
    {

        if (!Gate::allows('edit user')) abort(404);

        $roles = Role::all();

        return view('users.edit', compact('roles', 'user'));
    }

    public function update(StoreRequest $request, User $user)
    {
        if (!Gate::allows('update user')) abort(404);

        $user->name = $request->name;

        if($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $role = Role::findById($request->role_id);

        $user->assignRole($role);

        if ($request->expectsJson()) {
            return response()->json($user, 201);
        }

        if($request->submit_and_reload) {
            return redirect()->route('admin.users.edit', $user->id)->with('message', 'Успешно создано');
        }

        return redirect()->route('admin.users.index')->with('message', 'Успешно обновлено');

    }

    public function destroy(Request $request, User $user)
    {

        if (!Gate::allows('delete user')) abort(404);

        $user->delete();

        if ($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('admin.users.index')->with('message', 'Успешно удалено');


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

    public function changePassword(Request $request) {

        $password = $request->password;
        $repeatPassword = $request->repeat_password;

        if($password == $repeatPassword) {
            $user = auth()->user();
            $user->password = bcrypt($password);
            $user->save();

            return redirect()->back()->with('message', 'Успешно изменено');
        }

        return redirect()->back()->with('message', 'Не совпадают пароли');

    }
}
