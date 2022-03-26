<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MealRequest;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $per_page = 10;
        if (isset($request->per_page)) {
            $per_page = (int)$request->per_page;
        }
        $meals = Meal::query()
            ->when(isset($request->name), function ($q) use ($request) {
                return $q->where('name_uz', 'like', '%' . $request->name . '%')
                    ->orWhere('name_ru', 'like', '%' . $request->name . '%')
                    ->orWhere('name_en', 'like', '%' . $request->name . '%');
            })
            ->when(isset($request->category_id), function ($q) use ($request) {
                return $q->where('category_id', $request->category_id);
            })
            ->when(isset($request->restaurant_id), function ($q) use ($request) {
                return $q->where('restaurant_id', $request->restaurant_id);
            })
            ->orderByDesc('id')
            ->paginate($per_page);
        return response()->json([
            'data' => $meals
        ], 200);
    }

    public function store(MealRequest $request): \Illuminate\Http\JsonResponse
    {
        $uploadFile = $request->file('image_path');
        $path = 'meals/' . date('Y-m-d', time()) . '/' . $request->name;
        $fileName = $this->uploadFile($uploadFile, $path);
        $meal = new Meal();
        $meal->user_id = Auth::id();
        $meal->image_path = $fileName;
        $meal->restaurant_id = $request->restaurant_id;
        $meal->category_id = $request->category_id;
        $meal->name_uz = $request->name_uz;
        $meal->name_ru = $request->name_ru;
        $meal->name_en = $request->name_en;
        $meal->description_uz = $request->description_uz;
        $meal->description_ru = $request->description_ru;
        $meal->description_en = $request->description_en;
        $meal->price = $request->price;
        $meal->save();
        return response()->json([
            'data' => $meal
        ], 200);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $meal = Meal::query()->findOrFail($id);
        return response()->json([
            'data' => $meal
        ], 200);
    }

    public function update(MealRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        $meal = Meal::query()->findOrFail($id);
        if (!empty($request->image_path)) {
            $uploadFile = $request->file('image_path');
            $path = 'meals/' . date('Y-m-d', time()) . '/' . $request->name;
            $fileName = $this->uploadFile($uploadFile, $path);
            $meal->image_path = $fileName;
        }
        $meal->category_id = $request->category_id;
        $meal->name_uz = $request->name_uz;
        $meal->name_ru = $request->name_ru;
        $meal->name_en = $request->name_en;
        $meal->description_uz = $request->description_uz;
        $meal->description_ru = $request->description_ru;
        $meal->description_en = $request->description_en;
        $meal->price = $request->price;
        $meal->save();
        return response()->json([
            'user_id_type' => gettype($meal->user_id),
            'user_id' => $meal->user_id
        ], 200);
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $meal = Meal::query()->findOrFail($id);
        $meal->delete();
        return response()->json(true);
    }
}
