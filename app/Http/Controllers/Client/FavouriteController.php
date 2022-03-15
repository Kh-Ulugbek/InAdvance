<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\FavouriteRequest;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function index(Request $request)
    {
        $per_page = 10;
        if (isset($request->per_page)) {
            $per_page = (int)$request->per_page;
        }
        $favourite = Favourite::query()
            ->when(isset($request->name), function ($q) use ($request) {
                return $q->where('name_uz', 'like', '%' . $request->name . '%')
                    ->orWhere('name_ru', 'like', '%' . $request->name . '%')
                    ->orWhere('name_en', 'like', '%' . $request->name . '%');
            })
            ->orderByDesc('id')
            ->paginate($per_page);
        return response()->json([
            'data' => $favourite
        ], 200);
    }

    public function store(FavouriteRequest $request)
    {
        $favourite = Favourite::query()->create(
            [
                'user_id' => Auth::id(),
                'meal_id' => $request->meal_id
            ]
        );
        return response()->json([
            'data' => $favourite
        ], 200);
    }
}
