<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));

//        return response()->json($orders);
    }

    public function show(Order $order)
    {
        return response()->json($order);
    }


    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(null, 204);
    }
}
