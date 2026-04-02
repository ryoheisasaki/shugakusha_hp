<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MyPageController;

Route::get('/', function () {
    $is_logged_in = session()->has('user');
    $user_name = session('user.name', null);

    return view('pages.home', compact('is_logged_in', 'user_name'));
});

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/create', [BookController::class, 'create']);
Route::post('/books/store', [BookController::class, 'store']);
Route::get('/books/{id}', [BookController::class, 'show']);

Route::get('/admin/books', [BookController::class, 'adminIndex']);
Route::get('/admin/books/{id}/edit', [BookController::class, 'edit']);
Route::post('/admin/books/{id}/update', [BookController::class, 'update']);
Route::post('/admin/books/{id}/delete', [BookController::class, 'destroy']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);
Route::post('/cart/update/{id}', [CartController::class, 'update']);
Route::post('/cart/remove/{id}', [CartController::class, 'remove']);
Route::get('/cart/checkout', [CartController::class, 'checkout']);
Route::post('/cart/checkout', [CartController::class, 'sendOrderRequest']);
Route::get('/cart/complete', [CartController::class, 'complete']);

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'create']);
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy']);

Route::get('/mypage', [MyPageController::class, 'index']);
Route::get('/mypage/edit', [MyPageController::class, 'edit']);
Route::post('/mypage/update', [MyPageController::class, 'update']);
