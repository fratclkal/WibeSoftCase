<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('loginPost', [\App\Http\Controllers\AuthController::class, 'loginPost'])->name('login-post');

Route::group(['prefix' => 'panel'], function (){

    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function (){
        Route::get('task',[\App\Http\Controllers\TaskController::class,'Index'])->name('task');
        Route::get('task-form/{id?}', [\App\Http\Controllers\TaskController::class, 'Form'])->name('task-form');
        Route::post('task-save/{id?}', [\App\Http\Controllers\TaskController::class, 'Save'])->name('task-save');
        Route::get('task-delete/{id}', [\App\Http\Controllers\TaskController::class, 'Delete'])->name('task-delete');
    });

});

Route::get('register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('registerPost', [\App\Http\Controllers\AuthController::class, 'registerPost'])->name('register-post');

Route::middleware(['auth', 'user'])->group(function (){

});



