<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()
            ->with('table', 'restaurant')
            ->where('user_id', Auth::id())
            ->get();
        return response()->json([
            'data' => $orders
        ]);
    }

    public function store(OrderRequest $request)
    {
        $order = new Order;
        $order->user_id = Auth::id();
        $order->restaurant_id = $request->restaurant_id;
        $order->table_id = $request->table_id;
        $order->guest_count = $request->guest_count;
        $from = date('Y-m-d H:i:s', strtotime($request->book_from));
        $to = date('Y-m-d H:i:s', strtotime($request->book_to));
        $order->book_from = $from;
        $order->book_to = $to;
        $order->save();
        return response()->json(true);
    }
}
