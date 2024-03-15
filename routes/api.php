<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ClientController;

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

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function() {

    Route::get('/product/search/{id}', [ProductController::class, 'search'])->where('id', '[0-9]+');
    Route::get('/client/search/{cpf}', [ClientController::class, 'search'])->where('cpf', '[0-9]+');

    Route::get('/user', function (Request $request) { 
        return response()->json([$request->user()]);
    });
});