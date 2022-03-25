<?php

use App\Http\Controllers\Owner\CategoryController;
use App\Http\Controllers\Owner\MealController;
use App\Http\Controllers\Owner\RestaurantController;
use App\Http\Controllers\Owner\TableController;
use App\Http\Controllers\Client\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Client\FavouriteController;
use \App\Http\Controllers\AuthController;

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

//Route::middleware(['checkToken', 'auth:api'])->group(function () {
//    Route::middleware('scope:customer')->group(function () {
//        Route::post('profile', [AuthController::class, 'profile'])->name('user.profile');
//        Route::resource('favourite', FavouriteController::class)->only('index', 'store');
//        Route::resource('restaurant', RestaurantController::class)->only('index', 'show');
//        Route::resource('category', CategoryController::class)->only('index', 'show');
//        Route::resource('meal', MealController::class)->only('index', 'show');
//        Route::resource('table', TableController::class)->only('index', 'show');
//        Route::post('table/is-booked/{table_id}', [TableController::class, 'isBooked'])->name('table.isBooked');
//        Route::resource('order', OrderController::class)->only('index', 'store');
//    });
//});

Route::any('{any}', function() {
    return abort(404);
})->where('any', '.*');

