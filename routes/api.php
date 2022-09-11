<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanctumAuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('index',[SanctumAuthController::class,'index']);
Route::post('registro',[SanctumAuthController::class,'registro']);
Route::post('login',[SanctumAuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('perfil',[SanctumAuthController::class,'perfil']);
    Route::post('logout',[SanctumAuthController::class,'logout']);
});

Route::apiResource('posts',PostController::class);

Route::resource('products', ProductController::class);

