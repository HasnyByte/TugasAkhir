<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('auth.login'))->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::post('/logout', function () {
    Auth::logout();
    session()->flush();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Pages Routes
|--------------------------------------------------------------------------
*/

Route::get('/home', function () {
    return view('pages.home');
})->name('pages.home');

// Route untuk halaman Shop
Route::get('/shop', function () {
    return view('pages.shop');
})->name('pages.shop');

// Route untuk halaman Contact Us
Route::get('/contact', function () {
    return view('pages.contactus');
})->name('pages.contactus');
