<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Gate::allows('index order')) abort(404);

        $orders = Order::all();

        if($request->expectsJson()) {
            return response()->json($orders);
        }

        return view('orders.index', compact('orders'));

    }

    public function show(Request $request, Order $order)
    {

        if (!Gate::allows('show order')) abort(404);

        if($request->expectsJson()) {
            return response()->json($order);
        }

        return view('order.show', compact('order'));
    }


    public function destroy(Request $request, Order $order)
    {

        if (!Gate::allows('delete order')) abort(404);

        $order->delete();

        if($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('admin.orders.index')->with('message', 'Успешно удалено');

    }
}
