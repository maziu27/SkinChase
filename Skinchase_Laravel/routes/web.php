<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;

Route::get('/inventory', function () {
    return view('inventory');
})->name("inventory");

Route::get('/home', function(){
    return view('index');
})->name("home");

Route::get('/market', [MarketController::class, 'index'])->name("market");
Route::get('/api/fetch-data',[MarketController::class, 'fetchData']);

Route::get('/api/basket', [BasketController::class, 'getBasket']);
Route::post('/api/basket/add', [BasketController::class, 'addToBasket']); 
Route::post('/api/basket/remove', [BasketController::class, 'removeFromBasket']);
Route::post('/api/basket/clear', [BasketController::class, 'clearBasket']);
