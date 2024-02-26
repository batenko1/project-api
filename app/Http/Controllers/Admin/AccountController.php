<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();

        return view('accounts.index', compact('accounts'));

//        return response()->json($accounts);
    }


    public function store(Request $request) {

    }


    public function show(Account $account)
    {
        return response()->json($account);
    }


    public function update(Request $request, Account $account) {


    }


    public function destroy(Account $account)
    {
        $account->delete();

        return response()->json(null, 204);
    }

    public function orders(Account $account) {

        $orders = $account->orders;

        return response()->json($orders);

    }
}
