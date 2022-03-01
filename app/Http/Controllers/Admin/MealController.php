<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MealRequest;
use App\Models\Category;
use App\Models\Meal;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    public function index(Request $request)
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
            ->orderByDesc('id')
            ->paginate($per_page);
        return view('admin.pages.meal.index', compact('meals'));
    }

    public function create()
    {
        $categories = Category::query()->get();
        $restaurants = Restaurant::query()->get();
        return view('admin.pages.meal.create', compact('categories', 'restaurants'));
    }

    public function store(MealRequest $request)
    {
//        try {
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
            return redirect()->route('meals.index');
//        } catch (\Exception $e) {
//            return redirect()->back();
//        }
    }

    public function show($id)
    {
        $meal = Meal::query()->findOrFail($id);
        return $meal;
    }

    public function edit($id)
    {
        $categories = Category::query()->get();
        $restaurants = Restaurant::query()->get();
        $meal = Meal::query()->findOrFail($id);
        return view('admin.pages.meal.edit', compact('categories', 'restaurants', 'meal'));
    }

    public function update(MealRequest $request, $id)
    {
        $meal = Meal::query()->findOrFail($id);
        if(!empty($request->image_path)){
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
        return redirect()->route('meals.index');
    }

    public function destroy(int $id)
    {
        try {
            $meal = Meal::findOrFail($id);
            $meal->delete();
            return redirect()->route('meals.index');
        }catch (\Exception $e){
            return redirect()->back();
        }
    }
}
