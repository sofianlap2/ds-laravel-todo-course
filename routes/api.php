<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllerApi;
use App\Http\Controllers\TodoControllerApi;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthControllerApi::class, 'store'])->name('auth-api.store');

Route::post('login', [AuthControllerApi::class, 'doLogin'])->name('auth-api.doLogin');

Route::get('logout', [AuthControllerApi::class, 'logout'])->name('auth-api.logout');


Route::middleware('auth:sanctum')->get('/todo', [TodoControllerApi::class, 'index'])->name('todo-api.index')->middleware('role:admin');

Route::middleware('auth:sanctum')->post('/todo', [TodoControllerApi::class, 'store'])->name('todo-api.store');

Route::middleware('auth:sanctum')->get('todo-delete/{id}', [TodoControllerApi::class, 'destroy'])->name('todo-api.destroy');

Route::middleware('auth:sanctum')->put('todo-update/{id}', [TodoControllerApi::class, 'update'])->name('todo-api.update');
