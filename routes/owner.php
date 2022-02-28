<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Owner\RestaurantController;


Route::middleware(['checkToken', 'auth:api'])->group(function () {
    Route::middleware('scope:owner')->group(function () {
        Route::resource('restaurant', RestaurantController::class)->only('store', 'update');
    });
});
