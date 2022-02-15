<?php

use App\Http\Controllers\Client\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth routes
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::get('stock', [StockController::class, 'index']);
//Route::get('faq', [\App\Http\Controllers\Client\FAQController::class, 'index']);
//Route::get('faq-category', [\App\Http\Controllers\Client\FAQController::class, 'faqCategory']);
////Route::get('page', [\App\Http\Controllers\Client\PageController::class, 'index']);
//Route::get('page', [\App\Http\Controllers\Client\WebPageController::class, 'index']);
//Route::get('page/{page}', [\App\Http\Controllers\Client\WebPageController::class, 'show']);
//Route::get('blog', [\App\Http\Controllers\Client\WebPageBlogController::class, 'index']);

Route::middleware(['checkToken', 'auth:api'])->group(function () {
    //
});
