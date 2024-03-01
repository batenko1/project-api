<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validate;

class AuthController extends Controller
{

    public function __invoke(Request $request)
    {

        if(auth()->user()) {
            return redirect()->route('admin.main');
        }

        if($request->isMethod('post')) {

            $validatedData = $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8'
            ], [
                'email.required' => 'Почта обязательна',
                'email.email' => 'Неправильная почта',
                'email.exists' => 'Нет пользователя с такой почтой',
                'password.required' => 'Пароль обязателен',
                'password.min' => 'Слишком короткий пароль'
            ]);

            if(!$validatedData) {
                return redirect()->back()->withInput()->withErrors($validatedData->errors());
            }

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {

                return redirect()->route('admin.main');
            } else {
                return redirect()->back()->withInput()->withErrors([
                    'email' => 'Неправильный пароль'
                ]);
            }

        }

        return view('login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

}
