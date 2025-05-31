<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeLinkController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\makeTrade;
use App\Http\Controllers\mySQLController;

Route::get('/inventory', function () {
    return view('inventory');
})->name("inventory");

Route::get('/home', function(){
    return view('index');
})->name("home");

//test routes para probar MYSQL 
Route::get('/test', function () {
    return view('SQLTest');
})->name("test");
// para la vista de prueba que saca las mierdas de la base de datos
Route::get('/items', [mySQLController::class, 'getItemsJson']);


Route::get('/legal', function(){
    return view('legal');
})->name("legal");

//creacion del enlace de pago
Route::post('/create-stripe-link', [StripeLinkController::class, 'create']);

//rutas para redireccionamiento de pago
//Route::view('/payment-success', 'checkout-success');

Route::get('/payment-success')->name('payment.success');

Route::view('/payment-cancel', 'checkout-cancel');

Route::view('/inventory', 'inventory')->name('inventory');

//rutas para la pagina principal y el api para visualizar los productos
Route::get('/market', [MarketController::class, 'index'])->name("market");
Route::get('/api/fetch-data',[MarketController::class, 'fetchData']);

/*Rutas y elegancia para autenticación*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('auth/dashboard');
})->name('dashboard');

Route::get('/', function () {
    return view('auth/redirect');
})->name('redirect');