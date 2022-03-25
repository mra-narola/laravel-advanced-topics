<?php

use App\Http\Controllers\CartItemController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('cart-item', [CartItemController::class, 'index'])->name('cart-item.index');
Route::post('cart-item/store', [CartItemController::class, 'store'])->name('cart-item.store');