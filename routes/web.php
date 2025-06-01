<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('auth.login'))->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.submit');

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register'])->name('register.submit');

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

Route::get('/home', fn() => view('pages.home'))->name('pages.home');

Route::get('/shop', fn() => view('pages.shop'))->name('pages.shop');

Route::get('/contact', fn() => view('pages.contactus'))->name('pages.contactus');

Route::get('/cart', function () {
    $cart = session('cart', []);
    return view('pages.cart', ['cart' => $cart]);
})->name('pages.cart');

// Cart update route
Route::post('/cart/update', function (Request $request) {
    $cart = session('cart', []);
    $id = $request->input('id');
    $action = $request->input('action');

    if (isset($cart[$id])) {
        if ($action === 'increase') {
            $cart[$id]['quantity']++;
        } elseif ($action === 'decrease' && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        }
    }

    session(['cart' => $cart]);
    return back();
})->name('cart.update');

// Cart remove route
Route::post('/cart/remove', function (Request $request) {
    $cart = session('cart', []);
    unset($cart[$request->input('id')]);
    session(['cart' => $cart]);
    return back();
})->name('cart.remove');

// Checkout route
Route::post('/checkout', function (Request $request) {
    $cart = session('cart', []);

    if (empty($cart)) {
        return redirect()->route('pages.cart')->with('error', 'Keranjang kosong!');
    }

    session()->forget('cart'); // kosongkan cart
    return redirect()->route('pages.cart')->with('success', 'Checkout berhasil!');
})->name('cart.checkout');

// Clear cart
Route::post('/cart/clear', function () {
    session()->forget('cart');
    return back();
})->name('cart.clear');

// Tambah produk ke cart
Route::post('/add-to-cart', function (Request $request) {
    $cart = session()->get('cart', []);
    $id = uniqid(); // Bisa diganti dengan ID produk asli

    $cart[$id] = [
        'id' => $id,
        'name' => $request->name,
        'price' => $request->price,
        'image' => $request->image,
        'quantity' => 1
    ];

    session(['cart' => $cart]);
    return response()->json(['message' => 'Product added to cart']);
})->name('cart.add');

Route::post('/cart/update', function (Request $request) {
    $cart = session('cart', []);
    $id = $request->input('id');
    $action = $request->input('action');

    if (isset($cart[$id])) {
        if ($action === 'increase') {
            $cart[$id]['quantity']++;
        } elseif ($action === 'decrease' && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        }
    }

    session(['cart' => $cart]);
    return back();
})->name('cart.update');
