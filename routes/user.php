<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RatesController;
use App\Http\Controllers\questionController;
use App\Http\Controllers\ProductsController;

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/confirm', [CartController::class, 'confirm'])->name('confirm');
    Route::post('/order/confirm', [CartController::class, 'confirmOrder'])->name('order.confirm');
    Route::post('/confirm-info', [OrdersController::class, 'confirmInfo'])->name('confirm.info');

    Route::post('/product/{id}/rate', [RatesController::class, 'store'])->name('product.rate');

    Route::get('/send', [questionController::class, 'send'])->name('question');
    Route::get('/my_q', [questionController::class, 'my_q'])->name('my_q');
    Route::post('/send_Q', [questionController::class, 'store'])->name('send.store');

    Route::get('/my_orders', [OrdersController::class, 'my_orders'])->name('my.orders');

    Route::get('/products/male', [ProductsController::class, 'men'])->name('products.male');
    Route::get('/products/female', [ProductsController::class, 'women'])->name('products.female');
    Route::get('/products/{id}', [ProductsController::class, 'products_show'])->name('products.show');
    Route::get('/every', [ProductsController::class, 'every'])->name('every');
});
