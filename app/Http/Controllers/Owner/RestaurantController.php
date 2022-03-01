<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\RestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $uploadFile = $request->file('image_path');
        $path = 'restaurants/' . date('Y-m-d', time());
        $fileName = $this->uploadFile($uploadFile, $path);
        $restaurant = new Restaurant();
        $restaurant->user_id = Auth::guard('api')->id();
        $restaurant->image_path = $fileName;
        $restaurant->name = $request->name;
        $restaurant->phone = $request->phone;
        $restaurant->map_ln = $request->map_ln;
        $restaurant->map_lt = $request->map_lt;
        $restaurant->open_time = $request->open_time;
        $restaurant->close_time = $request->close_time;
        $restaurant->bank_number = $request->bank_number;
        $restaurant->save();
        return response()->json($restaurant);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return response()->json($restaurant);
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
