<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 10;
        if (isset($request->per_page)) {
            $paginate = (int) $request->per_page;
        }
        $stock = Stock::query()->paginate($paginate);
        return $this->responseSuccess($stock);
    }
}
