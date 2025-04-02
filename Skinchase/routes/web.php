<?php

use App\Http\Controllers\MarketController;
use App\Http\Controllers\SteamInventoryController;
use Illuminate\Support\Facades\Route;

Route::get('/inventory', function () {
    return view('inventory');
})->name("inventory");

Route::get('/home', function(){
    return view('index');
})->name("home");

Route::get('/market', [MarketController::class, 'index'])->name("market");
Route::get('/api/fetch-data',[MarketController::class, 'fetchData']);

//Route::get('/steam-inventory',[SteamInventoryController::class, 'fetchInventory']);