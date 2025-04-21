<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeLinkController;


Route::get('/inventory', function () {
    return view('inventory');
})->name("inventory");

Route::get('/home', function(){
    return view('index');
})->name("home");

//test routes for payment
Route::get('/test', function () {
    return view('stripeTest');
})->name("test");

Route::post('/create-stripe-link', [StripeLinkController::class, 'create']);


Route::get('/market', [MarketController::class, 'index'])->name("market");
Route::get('/api/fetch-data',[MarketController::class, 'fetchData']);