<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

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

        $user = DB::connection('mysql_bonuses')
            ->table('users')
            ->where('identification_code', $account->identification_code)
            ->first();

        $bonuses = [];

        if($user) {
            $bonuses = DB::connection('mysql_bonuses')
                ->table('bonuses')
                ->where('user_id', $user->id)
                ->get();

        }


        if($request->expectsJson()) {
            return response()->json(compact('account', 'bonuses'));
        }

        return view('accounts.show', compact('account', 'bonuses'));
    }

    public function edit(Account $account) {

        return view('accounts.edit', compact('account'));
    }


    public function update(Request $request, Account $account) {

        if (!Gate::allows('update account')) abort(404);

        $account->fio = $request->fio;
        $account->identification_code = $request->identification_code;
        $account->is_verified = $request->is_verified;
        $account->save();

        if ($request->expectsJson()) {
            return response()->json($account, 201);
        }

        return redirect()->route('admin.accounts.index')->with('message', 'Успешно обновлено');



    }


    public function destroy(Request $request, Account $account)
    {

        if (!Gate::allows('delete account')) abort(404);

        $account->orders()->delete();
        $account->photos()->delete();
        $account->delete();

        if($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('admin.accounts.index')->with('message', 'Успешно удалено');

    }

    public function orders(Account $account) {

        $orders = $account->orders;

        return response()->json($orders);

    }
}
