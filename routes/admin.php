<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\StockController;
use \App\Http\Controllers\Admin\FAQCategoryController;
use \App\Http\Controllers\Admin\FAQController;
use \App\Http\Controllers\Admin\PageController;
use \App\Http\Controllers\Admin\WebPageController;
use \App\Http\Controllers\Admin\WebPageBlogController;

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
    Route::resource('stock', StockController::class)->middleware('scope:admin,moderator');
//    Route::resource('faq-category', FAQCategoryController::class)->middleware('scope:admin,moderator');
//    Route::resource('faq', FAQController::class)->middleware('scope:admin,moderator');
////    Route::resource('page', PageController::class)->middleware('scope:admin,moderator');
//    Route::resource('page', WebPageController::class)->middleware('scope:admin,moderator');
//    Route::resource('blog', WebPageBlogController::class)->middleware('scope:admin,moderator');
});
