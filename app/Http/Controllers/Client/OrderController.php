<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\OrderRequest;
use App\Models\MealOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();
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

            foreach ($request->meals as $meal) {
                MealOrder::query()->create(
                    [
                        'order_id' => $order->id,
                        'meal_id' => $meal['meal_id'],
                        'count' => $meal['count']?? 1,
                    ]
                );
            }

            DB::commit();
            return response()->json(true);
        } catch (\Exception $exception) {
            DB::rollBack();
            echo $exception->getMessage();
        }
    }

    public function addMeal(int $id)
    {
        $meals = [
            [],
            [],
        ];
    }

    public function mealList(int $id)
    {
        return response()->json(
            [
                'data' => Order::query()->with('meal')
            ]
        );
    }
}
