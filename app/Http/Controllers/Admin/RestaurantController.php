<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\RestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $per_page = 10;
        if (isset($request->per_page)) {
            $per_page = (int) $request->per_page;
        }
        $restaurants = Restaurant::query()->with('user')
            ->when(isset($request->name), function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request->name . '%');
            })
            ->orderByDesc('id')
            ->paginate($per_page);
        return view('admin.pages.restaurant.index', compact('restaurants'));
    }

    public function edit($id)
    {
        $restaurant = Restaurant::query()->with('user')->findOrFail($id);
        return view('admin.pages.restaurant.edit', compact('restaurant'));
    }

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
        return redirect()->route('restaurants.index');
    }

    public function destroy(int $id)
    {
//        try {
//            $category = Restaurant::findOrFail($id);
//            $category->delete();
//            return redirect()->route('restaurants.index');
//        }catch (\Exception $e){
            return redirect()->back();
//        }
    }
}
