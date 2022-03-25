<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Owner\RestaurantController;
use \App\Http\Controllers\Owner\CategoryController;
use \App\Http\Controllers\Owner\MealController;
use \App\Http\Controllers\Owner\TableController;
use \App\Http\Controllers\Owner\OrderController;


//Route::middleware(['checkToken', 'auth:api'])->group(function () {
//    Route::middleware('scope:owner')->group(function () {
//        Route::resource('restaurant', RestaurantController::class)->only('index', 'show','store', 'update');
//        Route::resource('category', CategoryController::class)->only('index', 'show', 'store');
//        Route::resource('meal', MealController::class);
//        Route::resource('table', TableController::class)->only('index', 'show','store', 'update', 'destroy');
//        Route::resource('order', OrderController::class)->only('index');
//    });
//});


Route::any('{any}', function() {
    return abort(404);
})->where('any', '.*');
