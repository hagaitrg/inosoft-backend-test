<?php

use App\Http\Controllers\API\Auth\UserController;
use App\Http\Controllers\API\Main\KendaraanController;
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

Route::prefix('v1')->group(function(){
    Route::prefix('users')->group(function(){
        Route::post('register', [UserController::class,'register']);
        Route::post('login', [UserController::class,'login']);
    });

    Route::middleware('jwt.verify')->group(function(){
        Route::prefix('kendaraans')->group(function(){
            Route::prefix('motors')->group(function(){
                Route::post('store', [KendaraanController::class,'storeMotor']);
            });
        });
    });
});