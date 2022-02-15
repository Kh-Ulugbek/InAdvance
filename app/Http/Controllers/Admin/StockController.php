<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StockRequest;
use App\Http\Resources\StockResource;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $paginate = 10;
        if (isset($request->per_page)) {
            $paginate = (int) $request->per_page;
        }
        $stock = Stock::query()->paginate($paginate);
        return $this->responseSuccess($stock);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StockRequest $request)
    {
        $uploadFile = $request->file('image');
        $path = 'stocks/'.date('Y-m-d', time());
        $fileName = $this->uploadFile($uploadFile, $path);
        $stock = new Stock();
        $stock->created_by = Auth::guard('api')->id();
        $stock->title_ua = $request->title_ua;
        $stock->title_en = $request->title_en;
        $stock->description_en = $request->description_en;
        $stock->description_ua = $request->description_ua;
        $stock->text_ua = $request->text_ua;
        $stock->text_en = $request->text_en;
        $stock->start_date = $request->start_date;
        $stock->end_date = $request->end_date;
        $stock->status = $request->status;
        $stock->image = $fileName;
        if ($stock->save()) {
            return $this->responseSuccess($stock);
        }
        return $this->responseFail(422);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $stock = Stock::query()->findOrFail($id);
        return $this->responseSuccess($stock);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StockRequest $request, $id)
    {
        $stock = Stock::query()->findOrFail($id);
        if (!empty($request->file('image'))) {
            $uploadFile = $request->file('image');
            $path = 'stocks/'.date('Y-m-d', time());
            $fileName = $this->uploadFile($uploadFile, $path);
            $stock->image = $fileName;
        }
        $stock->created_by = Auth::guard('api')->id();
        $stock->title_ua = $request->title_ua;
        $stock->title_en = $request->title_en;
        $stock->description_en = $request->description_en;
        $stock->description_ua = $request->description_ua;
        $stock->text_ua = $request->text_ua;
        $stock->text_en = $request->text_en;
        $stock->start_date = $request->start_date;
        $stock->end_date = $request->end_date;
        $stock->status = $request->status;

        if ($stock->save()) {
            return $this->responseSuccess($stock);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Stock::query()->findOrFail($id)->delete()) {
            return $this->responseDelete();
        }
        return $this->responseFail(422);
    }
}
