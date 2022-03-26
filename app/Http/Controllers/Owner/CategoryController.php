<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function store(CategoryRequest $request)
    {
        try {
            $category = new Category();
//            $file = $request->file('image_path');
//            $file_path = "/storage/" . Storage::disk('public')->put("categories", $file);
            $category->name_uz = $request->name_uz;
            $category->name_ru = $request->name_ru;
            $category->name_en = $request->name_en;
            $category->description_uz = $request->description_uz;
            $category->description_ru = $request->description_ru;
            $category->description_en = $request->description_en;
//            $category->image_path = $file_path;
            $category->save();
            return response()->json([
                'data' => $category
            ], 200);
        } catch (\Exception $e) {
            return redirect()->back();
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
        $categories = Category::query()->findOrFail($id);
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
