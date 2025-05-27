<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Trade;
use App\Models\Item;

class makeTrade extends Controller
{
    public function comprarItem()
    {
        $itemId = Session::get('item_id');

        if (!$itemId) {
            return redirect('home')->with('error', 'No se encontró el ID del ítem en la sesión.');
        }

        $item = Item::findOrFail($itemId);
        $user = Auth::user();

        Trade::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        // Limpiar el item_id de la sesión
        Session::forget('item_id');

        return view('checkout-success', compact('item'));
    }
}
