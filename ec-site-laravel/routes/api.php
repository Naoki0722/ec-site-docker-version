<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StripesController;
use App\Http\Controllers\LoginController;


Route::apiResource('/users', UsersController::class);
Route::apiResource('/carts', CartsController::class);
Route::apiResource('/likes', LikesController::class);
Route::apiResource('categories', CategoriesController::class);
Route::apiResource('categories.products', ProductsController::class);
Route::post('/login', [LoginController::class, 'login']);
// 決済システムのためのセッション作成
Route::post('/stripes', [StripesController::class, 'createSession']);



Route::delete('/carts', [CartsController::class, 'delete']);
Route::delete('/likes', [LikesController::class, 'delete']);


