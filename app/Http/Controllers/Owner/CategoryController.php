<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $categories = Category::query()->orderByDesc('id')
            ->when(isset($request->name), function ($q) use ($request) {
                return $q->where('name_uz', 'like', '%' . $request->name . '%')
                    ->orWhere('name_ru', 'like', '%' . $request->name . '%')
                    ->orWhere('name_en', 'like', '%' . $request->name . '%');
            })
            ->paginate($per_page);
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
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $categories = Category::with('dacha')->findOrFail($id);
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
}
