<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RatesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\questionController;


use Illuminate\Support\Facades\Route;

 Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::get('/settings', [ProfileController::class, 'setting'])->name('settings');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::get('/my_orders', [OrdersController::class, 'my_orders'])->name('my.orders');

Route::get('/products/male', [ProductsController::class, 'men'])->name('products.male');
Route::get('/products/female', [ProductsController::class, 'women'])->name('products.female');
Route::get('/products/{id}', [ProductsController::class, 'products_show'])->name('products.show');
Route::get('/every', [ProductsController::class, 'every'])->name('every');
Route::get('/products/search', [ProductsController::class, 'search'])->name('products.search');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::get('/confirm', [CartController::class, 'confirm'])->name('confirm');
Route::post('/order/confirm', [CartController::class, 'confirmOrder'])->name('order.confirm');
Route::post('/confirm-info', [OrdersController::class, 'confirmInfo'])->name('confirm.info');
Route::post('/product/{id}/rate', [RatesController::class, 'store'])->name('product.rate');
Route::get('/send', [questionController::class, 'send'])->name('question');
Route::get('/my_q', [questionController::class, 'my_q'])->name('my_q');
Route::post('send_Q', [questionController::class, 'store'])->name('send.store');

});



Route::middleware('admin')->group(function () {

 Route::get('/admin_page', [HomeController::class, 'admin_page'])->name('admin.page');

Route::get('/add_product_form', [ProductsController::class, 'showAddForm'])->name('add_product_form');
Route::post('/add-product', [ProductsController::class, 'add_product'])->name('add_product');
Route::get('/users', [UsersController::class, 'show'])->name('users');
Route::get('/orders', [OrdersController::class, 'show'])->name('orders');
Route::get('/all_orders', [OrdersController::class, 'all_orders'])->name('all_orders');
Route::get('/users/{id}', [UsersController::class, 'show_profile'])->name('users.show');


Route::get('orders/{order}/cancel', [OrdersController::class, 'cancel'])->name('orders.cancel');
Route::get('orders/{order}/delivering', [OrdersController::class, 'delivering'])->name('orders.delivering');
Route::get('orders/{order}/preparing', [OrdersController::class, 'preparing'])->name('orders.preparing');
Route::get('orders/{order}/deliverd', [OrdersController::class, 'deliverd'])->name('orders.deliverd');

Route::get('/users/{user}/promote', [AdminController::class, 'promote'])->name('users.promote');
Route::get('/users/{user}/remove', [AdminController::class, 'destroy'])->name('users.remove');
Route::get('/users/{user}/demote', [AdminController::class, 'admin_delete'])->name('users.demote');
Route::get('/show_Q', [questionController::class, 'show'])->name('show_q');
 Route::post('answer/store', [questionController::class, 'store_A'])->name('answer.store');



    });




require __DIR__.'/auth.php';


