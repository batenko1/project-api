<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CancelOrderAction extends Controller
{
    public function __invoke(Request $request)
    {
        $orderId = $request->get('order_id');

        $order = Order::query()->findOrFail($orderId);

        $order->status = 'cancel';

        $order->save();

        return response()->json(['status' => 'cancel']);
    }
}
