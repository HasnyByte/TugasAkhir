<?php
//
//use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Auth;
//use App\Http\Controllers\AuthController;
//use App\Http\Controllers\CartController;
//
///*
//|--------------------------------------------------------------------------
//| Auth Routes
//|--------------------------------------------------------------------------
//*/
//Route::get('/', function () {
//    return redirect('/login');
//});
//
//// Guest routes (untuk user yang belum login)
//Route::middleware('guest')->group(function () {
//    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
//    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
//
//    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
//    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
//});
//
//// Protected routes (untuk user yang sudah login)
//Route::middleware('auth')->group(function () {
//    // Route untuk halaman home setelah login
//    Route::get('/home', function () {
//        return view('pages.home');
//    })->name('home');
//
//    // Route logout
//    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//});
//
///*
//|--------------------------------------------------------------------------
//| Pages Routes
//|--------------------------------------------------------------------------
//*/
//Route::get('/home', function () {
//    return view('pages.home');
//})->name('pages.home');
//
//Route::get('/shop', function () {
//    return view('pages.shop');
//})->name('pages.shop');
//
//Route::get('/contact', function () {
//    return view('pages.contactus');
//})->name('pages.contactus');
//
///*
//|--------------------------------------------------------------------------
//| Cart Routes - Using Controller
//|--------------------------------------------------------------------------
//*/
//Route::prefix('cart')->name('cart.')->group(function () {
//    Route::get('/', [CartController::class, 'index'])->name('index');
//    Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
//    Route::post('/increase/{id}', [CartController::class, 'increase'])->name('increase');
//    Route::post('/decrease/{id}', [CartController::class, 'decrease'])->name('decrease');
//    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
//    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
//});
//
//// Alias route untuk backward compatibility
//Route::get('/cart', [CartController::class, 'index'])->name('pages.cart');


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/login');
});

// Guest routes (untuk user yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// Protected routes (untuk user yang sudah login)
Route::middleware('auth')->group(function () {
    // Route untuk halaman home setelah login
    Route::get('/home', function () {
        return view('pages.home');
    })->name('home');

    // Route logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Pages Routes
|--------------------------------------------------------------------------
*/
Route::get('/home', function () {
    return view('pages.home');
})->name('pages.home');

Route::get('/shop', function () {
    return view('pages.shop');
})->name('pages.shop');

Route::get('/contact', function () {
    return view('pages.contactus');
})->name('pages.contactus');

/*
|--------------------------------------------------------------------------
| Cart Routes - Using Controller
|--------------------------------------------------------------------------
*/
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    // Changed: Remove {id} parameter from add route since you're sending product data via JSON
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::post('/increase/{id}', [CartController::class, 'increase'])->name('increase');
    Route::post('/decrease/{id}', [CartController::class, 'decrease'])->name('decrease');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
});

// Alias route untuk backward compatibility
Route::get('/cart', [CartController::class, 'index'])->name('pages.cart');
