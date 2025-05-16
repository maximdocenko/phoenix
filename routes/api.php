<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AdminController;


Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware(['jwt.auth'])->group(function () {

    Route::get('books', [BookController::class, 'index']);
    Route::post('books', [BookController::class, 'store']);
    Route::put('books/{id}', [BookController::class, 'update']);
    Route::delete('books/{id}', [BookController::class, 'destroy']);

    Route::post('purchase/{bookId}', [PurchaseController::class, 'purchase']);

    Route::post('admin/ban/{userId}', [AdminController::class, 'banUser']);
    Route::get('admin/stats', [AdminController::class, 'stats']);
});
