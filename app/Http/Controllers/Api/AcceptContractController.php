<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AcceptContractRequest;
use App\Models\Account;
use App\Models\Order;
use Illuminate\Http\Request;

class AcceptContractController extends Controller
{
    public function __invoke(AcceptContractRequest $request)
    {

        $order = Order::query()->find($request->order_id);
        $account = Account::query()->find($request->account_id);

        if($order->account_id == $account->id) {
            $order->is_agree = 1;
            $order->save();

            return response()->json($order, 201);
        }

        abort(404);

    }
}
