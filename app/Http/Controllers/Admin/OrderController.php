<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::all();

        if($request->expectsJson()) {
            return response()->json($orders);
        }

        return view('orders.index', compact('orders'));

//        return response()->json($orders);
    }

    public function show(Request $request, Order $order)
    {
        if($request->expectsJson()) {
            return response()->json($order);
        }

        return view('order.show', compact('order'));
    }


    public function destroy(Request $request, Order $order)
    {
        $order->delete();

        if($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->back()->with('message', 'Success');

    }
}
