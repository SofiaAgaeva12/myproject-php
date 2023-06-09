<?php

use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [UserController::class, 'login']);
Route::middleware('auth:api')->get('/logout', [UserController::class, 'logout']);

Route::apiResource('user', \App\Http\Controllers\UserController::class, ['only' => ['index', 'store']])
    ->middleware('role:admin');
