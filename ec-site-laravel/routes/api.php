<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StripesController;


Route::apiResource('/users', UsersController::class);
Route::apiResource('/carts', CartsController::class);
Route::apiResource('/likes', LikesController::class);
Route::apiResource('categories', CategoriesController::class);
Route::apiResource('categories.products', ProductsController::class);
// 決済システムのためのセッション作成
Route::post('/stripes', [StripesController::class, 'createSession']);



// テスト用です。
Route::get('/sample', [ProductsController::class, 'sample']);


