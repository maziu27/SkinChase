<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeLinkController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\makeTrade;
use App\Http\Controllers\mySQLController;
use App\Http\Controllers\SteamController;

// Web Routes
Route::get('/', function () {
    return view('auth/redirect');
})->name('redirect');

Route::get('/home', function(){
    return view('index');
})->name("home");

Route::get('/market', [MarketController::class, 'index'])->name("market");
Route::get('/legal', function(){
    return view('legal');
})->name("legal");

Route::get('/inventory', function () {
    return view('inventory');
})->name("inventory");

Route::get('/stall',function(){
    return view('stall');
})->name("stall");

// Ruta de prueba que utilicé para mostrar los productos desde mySQL
Route::get('/test', function () {
    return view('SQLTest');
})->name("test");
Route::get('/items', [mySQLController::class, 'getItemsJson']);

// Payment routes
Route::post('/create-stripe-link', [StripeLinkController::class, 'create']);
Route::get('/payment-success', [makeTrade::class, 'registrarCompra'])->name('payment-success');
Route::view('/payment-cancel', 'market');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('auth/dashboard');
})->name('dashboard');

// API Routes
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::get('/api/steam/inventory', [SteamController::class, 'fetchSteamInventory']);
Route::get('/api/fetch-data', [MarketController::class, 'fetchData']);

// User Items API Routes
Route::prefix('api')->group(function () {
    Route::get('/user/items', [ItemController::class, 'getUserItems']);
    Route::put('/items/{id}', [ItemController::class, 'update']);
    Route::get('/user/transactions', [makeTrade::class, 'getUserTransactions']);

});

// Market API Routes
Route::prefix('api/market')->group(function () {
    Route::get('/', [MarketController::class, 'fetchData']);
});

// Steam API Routes
Route::prefix('api/steam')->group(function () {
    Route::get('/inventory', [SteamController::class, 'fetchSteamInventory']);
});