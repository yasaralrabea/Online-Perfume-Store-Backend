<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;

Route::get('/user_page', [HomeController::class, 'home'])->name('user.page');
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/sttings', [settingsController::class, 'settings'])->name('settings');


require __DIR__.'/user.php';

require __DIR__.'/admin.php';

require __DIR__.'/auth.php';
