<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TodoController::class, 'index'])->name('todo.index')->middleware('auth');

Route::post('/', [TodoController::class, 'store'])->name('todo.store')->middleware('auth');

Route::get('todo-delete/{id}', [TodoController::class, 'destroy'])->name('todo.destroy')->middleware('auth');

Route::get('todo-edit/{id}', [TodoController::class, 'edit'])->name('todo.edit')->middleware('auth');

Route::put('todo-update/{id}', [TodoController::class, 'update'])->name('todo.update')->middleware('auth');

Route::get('register', [AuthController::class, 'index'])->name('auth.register');

Route::post('register', [AuthController::class, 'store'])->name('auth.store');

Route::get('login', [AuthController::class, 'indexLogin'])->name('auth.indexLogin');

Route::post('login', [AuthController::class, 'doLogin'])->name('auth.doLogin');

Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
