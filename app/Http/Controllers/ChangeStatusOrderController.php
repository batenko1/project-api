<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ChangeStatusOrderController extends Controller
{
    public function __invoke(Request $request)
    {

        $order = Order::query()->findOrFail($request->order_id);
        $order->status = $request->status;
        $order->save();

        return response()->json($order, 201);

    }
}
