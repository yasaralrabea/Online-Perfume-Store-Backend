<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\questionController;

Route::prefix('admin')->middleware(['auth','admin'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'admin_page'])->name('admin.page');

    Route::get('/add_product_form', [ProductsController::class, 'showAddForm'])->name('add_product_form');
    Route::post('/add-product', [ProductsController::class, 'add_product'])->name('add_product');

    Route::get('/users', [UsersController::class, 'show'])->name('users');
    Route::get('/users/{id}', [UsersController::class, 'show_profile'])->name('users.show');
    Route::get('/users/{user}/promote', [AdminController::class, 'promote'])->name('users.promote');
    Route::get('/users/{user}/remove', [AdminController::class, 'destroy'])->name('users.remove');
    Route::get('/users/{user}/demote', [AdminController::class, 'admin_delete'])->name('users.demote');

    Route::get('/orders', [OrdersController::class, 'show'])->name('orders');
    Route::get('/all_orders', [OrdersController::class, 'all_orders'])->name('all_orders');
    Route::get('/orders/{order}/cancel', [OrdersController::class, 'cancel'])->name('orders.cancel');
    Route::get('/orders/{order}/delivering', [OrdersController::class, 'delivering'])->name('orders.delivering');
    Route::get('/orders/{order}/preparing', [OrdersController::class, 'preparing'])->name('orders.preparing');
    Route::get('/orders/{order}/deliverd', [OrdersController::class, 'deliverd'])->name('orders.deliverd');

    Route::get('/show_Q', [questionController::class, 'show'])->name('show_q');
    Route::post('/answer/store', [questionController::class, 'store_A'])->name('answer.store');
});
