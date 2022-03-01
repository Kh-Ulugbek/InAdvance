<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $per_page = 10;
        if (isset($request->per_page)) {
            $per_page = (int) $request->per_page;
        }
        $categories = Category::query()
            ->when(isset($request->name), function ($q) use ($request) {
                return $q->where('name_uz', 'like', '%' . $request->name . '%')
                    ->orWhere('name_ru', 'like', '%' . $request->name . '%')
                    ->orWhere('name_en', 'like', '%' . $request->name . '%');
            })
            ->orderByDesc('id')
            ->paginate($per_page);
        return view('admin.pages.category.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.pages.category.create');
    }


    public function store(CategoryRequest $request)
    {
        try {
            $category = new Category();
            $file = $request->file('image_path');
            $file_path = "/storage/" . Storage::disk('public')->put("categories", $file);
            $category->name_uz = $request->name_uz;
            $category->name_ru = $request->name_ru;
            $category->name_en = $request->name_en;
            $category->description_uz = $request->description_uz;
            $category->description_ru = $request->description_ru;
            $category->description_en = $request->description_en;
            $category->image_path = $file_path;
            $category->save();
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }


    public function show($id)
    {
        $category = Category::query()->findOrFail($id);
    }


    public function edit($id)
    {
        $category = Category::query()->findOrFail($id);
        return view('admin.pages.category.edit', compact('category'));
    }


    public function update(CategoryRequest $request, int $id)
    {
        try {
            $category = Category::findOrFail($id);
            if(!empty($request->image_path)){
                $file = $request->file('image_path');
                $file_path = "/storage/" . Storage::disk('public')->put("categories", $file);
                $category->update([
                    'name_uz' => $request->name_uz,
                    'name_ru' => $request->name_ru,
                    'name_en' => $request->name_en,
                    'description_uz' => $request->description_uz,
                    'description_ru' => $request->description_ru,
                    'description_en' => $request->description_en,
                    'image_path' => $file_path,
                ]);
            }else{
                $category->update([
                    'name_uz' => $request->name_uz,
                    'name_ru' => $request->name_ru,
                    'name_en' => $request->name_en,
                    'description_uz' => $request->description_uz,
                    'description_ru' => $request->description_ru,
                    'description_en' => $request->description_en,
                ]);
            }
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }


    public function destroy(int $id)
    {
//        try {
//            $category = Category::findOrFail($id);
//            $category->delete();
//            return redirect()->route('category.index');
//        }catch (\Exception $e){
            return redirect()->back();
//        }
    }
}
