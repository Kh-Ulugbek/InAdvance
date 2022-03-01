<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Owner\RestaurantController;
use \App\Http\Controllers\Owner\CategoryController;
use \App\Http\Controllers\Owner\MealController;


Route::middleware(['checkToken', 'auth:api'])->group(function () {
    Route::middleware('scope:owner')->group(function () {
        Route::resource('restaurant', RestaurantController::class)->only('index', 'show','store', 'update');
        Route::resource('category', CategoryController::class)->only('index', 'show');
        Route::resource('meal', MealController::class);
    });
});
