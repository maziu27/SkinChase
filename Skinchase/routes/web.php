<?php

use App\Http\Controllers\SteamInventoryController;
use Illuminate\Support\Facades\Route;

Route::get('/inventory', function () {
    return view('inventory');
});

Route::get('/steam-inventory',[SteamInventoryController::class, 'fetchInventory']);