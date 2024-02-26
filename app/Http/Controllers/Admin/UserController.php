<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController {


    public function index() {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create() {

        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request) {

    }

    public function update(Request $request, User $user) {

    }

    public function destroy(User $user) {

        $user->delete();

        return response()->json(null, 204);

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
