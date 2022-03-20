<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\TableRequest;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $per_page = 10;
        if (isset($request->per_page)) {
            $per_page = (int) $request->per_page;
        }
        $restaurant = Restaurant::query()->where('user_id', Auth::id())->firstOrFail();
        $tables = Table::query()
            ->with('orders')
            ->where('restaurant_id', $restaurant->id)
            ->when(isset($request->name), function ($q) use ($request) {
                return $q->where('index', $request->name);
            })
            ->orderBy('index')
            ->paginate($per_page);
        try {
            return response()->json([
                'data' => $tables
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception,
                'message' => 'Something went wrong'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TableRequest $request
     * @return JsonResponse
     */
    public function store(TableRequest $request): JsonResponse
    {
        $count = $request->count??1;
        for ($i = 0; $i <= $count; $i++) {
            $restaurant = Restaurant::query()->where('user_id', Auth::id())->firstOrFail();
            $highest = Table::query()->where('restaurant_id', $restaurant->id)->orderByDesc('index')->first();
            Table::query()->create(
                [
                    'restaurant_id' => $restaurant->id,
                    'set_num' => $request->set_num,
                    'price' => $request->price,
                    'floor' => $request->floor,
                    'index' => (!empty($highest->index))? $highest->index + 1 : 1,
                ]
            );
        }
        $tables = Table::query()->where('restaurant_id', $restaurant->id)->get();
        return response()->json([
            'data' => $tables
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TableRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TableRequest $request, int $id)
    {
        $table = Table::query()->findOrFail($id);
        $table->set_num = $request->set_num;
        $table->price = $request->price;
        $table->floor = $request->floor;
        $table->index = $request->index;
        $table->save();
        return response()->json([
            'data' => $table
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $table = Table::query()->findOrFail($id);
        try {
            return response()->json([
                'data' => $table
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception,
                'message' => 'Something went wrong'
            ]);
        }
    }

    public function destroy(int $id)
    {
        Table::query()->findOrFail($id)->delete();
        return true;
    }

    public function isBooked(Request $request, int $id)
    {
        $from = (!empty($request->book_from))? date('Y-m-d H:i:s', strtotime($request->book_from)): null;
        $to = (!empty($request->book_to))? date('Y-m-d H:i:s', strtotime($request->book_to)): null;

        $table = Order::query()
            ->where('table_id', $id)
            ->when($from, function ($q) use ($from) {
                $q->where('book_from', '<=', $from);
            })
            ->when($to, function ($q) use ($to) {
                $q->where('book_to', '<=', $to);
            })
            ->get();
        return response()->json(
            [
                'data' => $table
            ]
        );
    }
}
