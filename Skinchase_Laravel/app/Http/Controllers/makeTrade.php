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
            'user_name' => $user->name,
            'item_id' => $item->id,
            'item_name' => $item->name,
        ]);

        // Limpiar el item_id de la sesión
        Session::forget('item_id');

        return view('checkout-success', compact('item'));
    }

    public function registrarCompra()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('login')->with('error', 'Debes iniciar sesión para completar la compra.');
        }

        $items = Session::get('purchased_items');

        if (!$items || empty($items)) {
            return redirect('home')->with('error', 'No se encontraron productos comprados.');
        }

        foreach ($items as $item) {
            $itemModel = Item::find($item['id'] ?? null);

            if (!$itemModel) {
                // Ignorar este item si no existe en la base de datos
                continue;
            }

            Trade::create([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'item_id' => $itemModel->id,
                'item_name' => $item['name'],
                'image' => $item['image'],
                'price' => $item['price'],
            ]);
        }

        Session::forget('purchased_items');

        return view('checkout-success', ['items' => $items]);
    }
}
