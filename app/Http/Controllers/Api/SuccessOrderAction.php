<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class SuccessOrderAction extends Controller
{
    public function __invoke(Request $request)
    {
        $orderId = $request->get('order_id');

        $order = Order::query()->findOrFail($orderId);

        $order->payment_status = 'success';
        $order->status = 'complete';

        $order->save();

        return response()->json(['status' => 'success']);
    }
}
