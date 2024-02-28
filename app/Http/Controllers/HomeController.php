<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {

//            event(new \App\Events\SendMessage(auth()->user()->id, 'test'));
//    return view('welcome');

        if(!auth()->user()) {

            return redirect()->route('login');
        }

    }
}
