<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;


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

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'check']);
Route::get('show/{id}', [LoginController::class, 'show']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::post('/users', [UserController::class, 'create'])->middleware('auth:sanctum');
Route::get('/user/{id}', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::put('/users/{id}/edit', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::get('/staffs', [UserController::class, 'staffs'])->middleware('auth:sanctum');

Route::get('/tickets',[TicketController::class, 'index'])->middleware('auth:sanctum');
Route::post('/tickets',[TicketController::class, 'store'])->middleware('auth:sanctum');
Route::get('/ticket/{id}', [TicketController::class, 'show'])->middleware('auth:sanctum');
Route::get('/tickets/{id}/edit',[TicketController::class, 'edit'])->middleware('auth:sanctum');
Route::put('/tickets/{id}/edit',[TicketController::class, 'update'])->middleware('auth:sanctum');
