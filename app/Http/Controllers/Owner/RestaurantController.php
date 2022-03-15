<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\RestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
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
        $restaurants = Restaurant::query()->orderByDesc('id')
            ->when(isset($request->name), function ($q) use ($request) {
                return $q->where('name_uz', 'like', '%' . $request->name . '%')
                    ->orWhere('name_ru', 'like', '%' . $request->name . '%')
                    ->orWhere('name_en', 'like', '%' . $request->name . '%');
            })
            ->paginate($per_page);
        try {
            return response()->json([
                'data' => $restaurants
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception,
                'message' => 'Something went wrong'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RestaurantRequest $request
     * @return JsonResponse
     */
    public function store(RestaurantRequest $request)
    {
        if (Restaurant::query()->where('user_id', Auth::id())->first()) {
            return response()->json('user already has restaurant', 422);
        }
        $uploadFile = $request->file('image_path');
        $path = 'restaurants/' . date('Y-m-d', time());
        $fileName = $this->uploadFile($uploadFile, $path);
        $restaurant = new Restaurant();
        $restaurant->user_id = Auth::id();
        $restaurant->image_path = $fileName;
        $restaurant->name = $request->name;
        $restaurant->phone = $request->phone;
        $restaurant->map_ln = $request->map_ln;
        $restaurant->map_lt = $request->map_lt;
        $restaurant->open_time = $request->open_time;
        $restaurant->close_time = $request->close_time;
        $restaurant->bank_number = $request->bank_number;
        $restaurant->save();
        return response()->json([
            'data' => $restaurant
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $categories = Restaurant::query()->findOrFail($id);
        try {
            return response()->json([
                'data' => $categories
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception,
                'message' => 'Something went wrong'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RestaurantRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(RestaurantRequest $request, int $id)
    {
        $restaurant = Restaurant::query()->findOrFail($id);
        if (!empty($request->file('image_path'))) {
            $uploadFile = $request->file('image_path');
            $path = 'restaurants/' . date('Y-m-d', time()) . '/' . $request->name;
            $fileName = $this->uploadFile($uploadFile, $path);
            $restaurant->image_path = $fileName;
        }
        $restaurant->name = $request->name;
        $restaurant->phone = $request->phone;
        $restaurant->map_ln = $request->map_ln;
        $restaurant->map_lt = $request->map_lt;
        $restaurant->open_time = $request->open_time;
        $restaurant->close_time = $request->close_time;
        $restaurant->bank_number = $request->bank_number;
        $restaurant->save();
        return response()->json([
            'data' => $restaurant
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
