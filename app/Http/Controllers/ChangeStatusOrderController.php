<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangeStatusOrderController extends Controller
{
    public function __invoke(Request $request)
    {

        $order = Order::query()->findOrFail($request->order_id);
        $order->status = $request->status;
        $order->save();

        if($order->status == 'cancel') {

            if($order->bonuses) {

                $user = DB::connection('mysql_bonuses')
                    ->table('users')
                    ->where('identification_code', $order->account->identification_code)
                    ->first();

                if($user) {
                    DB::connection('mysql_bonuses')
                        ->table('bonuses')
                        ->insert([
                            'user_id' => $user->id,
                            'bonuses' => $order->bonuses,
                            'type' => 'add'
                        ]);
                }

            }

        }

        return response()->json($order, 201);

    }
}
