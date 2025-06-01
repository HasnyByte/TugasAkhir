<?php

namespace App\Http\Controllers;
Route::get('/shop', [ShopController::class, 'index'])->name('pages.shop');
abstract class Controller
{
    //
}
