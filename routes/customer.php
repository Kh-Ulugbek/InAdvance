<?php

use App\Http\Controllers\Owner\CategoryController;
use App\Http\Controllers\Owner\MealController;
use App\Http\Controllers\Owner\RestaurantController;
use App\Http\Controllers\Owner\TableController;
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
        Route::resource('restaurant', RestaurantController::class)->only('index', 'show');
        Route::resource('category', CategoryController::class)->only('index', 'show');
        Route::resource('meal', MealController::class)->only('index', 'show');
        Route::resource('table', TableController::class)->only('index', 'show');
    });
});

