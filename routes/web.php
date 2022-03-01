<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\MealController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('category.index');
    });
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//    Route::get('/admin-panel', [MainController::class, 'index'])->name('adminPanel');

    ////////////////////// Category \\\\\\\\\\\\\\\\\\\\\
    Route::resource('/category', CategoryController::class);

    ////////////////////// Restaurants \\\\\\\\\\\\\\\\\\\\\
    Route::resource('/restaurants', RestaurantController::class);

    ////////////////////// Meals \\\\\\\\\\\\\\\\\\\\\
    Route::resource('/meals', MealController::class);
});

//Route::get('{any}', function() {
//    return redirect('/');
//})->where('any', '.*');
