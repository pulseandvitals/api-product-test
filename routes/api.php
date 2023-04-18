<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/',[ProductController::class,'index']);
    Route::post('/store',[ProductController::class,'store']);
    Route::get('/destroy/{id}',[ProductController::class,'destroy']);
    Route::get('/show/{id}',[ProductController::class,'show']);
    Route::patch('/edit/{id}',[ProductController::class,'edit']);
});
