<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::prefix('categories')->group(function(){
    Route::get('index',[HomeController::class, 'index']);
});

Route::prefix('admin')->group(function(){

    Route::get('admin-login',[AdminController::class,'index']);
    Route::get('admin-dashboard',[AdminController::class,'show_dashboard']);
});
