<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Client\FavouriteController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['checkToken', 'auth:api'])->group(function () {
    Route::middleware('scope:customer')->group(function () {
        Route::resource('favourite', FavouriteController::class)->only('index', 'store');
    });
});

