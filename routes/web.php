<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TodoListController;
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
    Route::get('add-new-account',[AdminController::class,'add_new_account_page']);
    Route::get('add-new-account',[AdminController::class,'show_role']);
    Route::get('add-new-role',[AdminController::class,'add_new_role_page']);
    Route::post('insert-role',[AdminController::class,'insertRole']);
    Route::post('create-account',[AdminController::class,'createAccount']);
    Route::post('admin-login',[AdminController::class,'admin_login']);
    Route::get('logout',[AdminController::class,'admin_logout']);
});

Route::prefix('todoList')->group(function(){
    Route::get('add-new-todo',[TodoListController::class,'add_new_todo_page']);
    Route::post('insert-task',[TodoListController::class,'insert_task']);
    Route::get('todo-list',[TodoListController::class,'show_todoList']);
    Route::get('delete-task/{id}',[TodoListController::class,'delete_task'])->name('task.delete');
});