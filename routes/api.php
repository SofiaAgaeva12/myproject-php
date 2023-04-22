<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkShiftController;
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

Route::post('login', [UserController::class, 'login'])->withoutMiddleware("auth:api");
Route::middleware('auth:api')->get('/logout', [UserController::class, 'logout']);


Route::middleware(['can:admin, App\models\User'])->group(function () {
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'create']);
    Route::get('user/{user}', [UserController::class, 'show']);

    Route::post('work-shift', [ShiftWorkerController::class, 'create']);
    Route::post('work-shift/{work}/open', [WorkShiftController::class, 'open']);
    Route::post('work-shift/{work}/close', [WorkShiftController::class, 'close']);

});
