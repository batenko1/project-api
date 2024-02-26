<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __invoke(Request $request)
    {

        if($request->isMethod('post')) {

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {

                return redirect()->route('admin.main');
            } else {
                return redirect()->back();
            }

        }

        return view('login');
    }

}
