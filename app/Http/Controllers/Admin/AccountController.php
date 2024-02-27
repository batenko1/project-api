<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!Gate::allows('index account')) abort(404);

        $accounts = Account::all();

        if($request->expectsJson()) {
            return response()->json($accounts);
        }

        return view('accounts.index', compact('accounts'));

    }


    public function store(Request $request) {

        if (!Gate::allows('store account')) abort(404);

    }


    public function show(Request $request, Account $account)
    {

        if (!Gate::allows('show product')) abort(404);

        if($request->expectsJson()) {
            return response()->json($account);
        }

        return view('accounts.show', compact('account'));
    }


    public function update(Request $request, Account $account) {

        if (!Gate::allows('update product')) abort(404);

        if($request->expectsJson()) {

        }

    }


    public function destroy(Request $request, Account $account)
    {

        if (!Gate::allows('delete product')) abort(404);

        $account->delete();

        if($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->back()->with('message', 'Success');

    }

    public function orders(Account $account) {

        $orders = $account->orders;

        return response()->json($orders);

    }
}
