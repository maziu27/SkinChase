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

Route::post('/checkout', function (Illuminate\Http\Request $request) {
    $basket = json_decode($request->input('basket_data'), true);
    
    // Process checkout: Save to DB, create order, call payment gateway, etc.
    
    return redirect()->back()->with('success', 'Checkout complete!');
})->name('checkout');
