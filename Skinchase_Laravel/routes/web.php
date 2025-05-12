<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeLinkController;
use App\Http\Controllers\AuthController;


Route::get('/inventory', function () {
    return view('inventory');
})->name("inventory");

Route::get('/home', function(){
    return view('index');
})->name("home");

//test route para probar stripe
Route::get('/test', function () {
    return view('stripeTest');
})->name("test");

//creacion del enlace de pago
Route::post('/create-stripe-link', [StripeLinkController::class, 'create']);

//rutas para redireccionamiento de pago
Route::view('/payment-success', 'checkout-success');
Route::view('/payment-cancel', 'checkout-cancel');

//rutas para la pagina principal y el api para visualizar los productos
Route::get('/market', [MarketController::class, 'index'])->name("market");
Route::get('/api/fetch-data',[MarketController::class, 'fetchData']);


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');