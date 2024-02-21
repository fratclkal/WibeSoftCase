<?php

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


Route::group(['prefix' => 'v2'],function (){

    Route::post('api-register', [\App\Http\Controllers\AuthController::class, 'apiRegisterPost']);
    Route::post('api-login', [\App\Http\Controllers\AuthController::class, 'apiLoginPost']);

    Route::group(['middleware' => 'api.token'],function (){

        Route::get('api-task',[\App\Http\Controllers\TaskController::class, 'apiIndex']);
        Route::get('api-task-form/{id}',[\App\Http\Controllers\TaskController::class, 'apiForm']);
        Route::post('api-task-save/{id?}',[\App\Http\Controllers\TaskController::class, 'apiSave']);
        Route::post('api-task-del/{id}',[\App\Http\Controllers\TaskController::class, 'apiDelete']);
    });

});

