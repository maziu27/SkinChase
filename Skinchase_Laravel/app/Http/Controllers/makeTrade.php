<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Trade;
use App\Models\Item;

class makeTrade extends Controller
{
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

        $createdTrades = [];
        
        foreach ($items as $item) {
            // Buscar el item en la base de datos por asset_id (que es el ID único de Steam)
            $itemModel = Item::where('asset_id', $item['id'])->first();

            // Si no existe el item, lo creamos en la base de datos
            if (!$itemModel) {
                $itemModel = Item::create([
                    'asset_id' => $item['id'],
                    'name' => $item['name'],
                    'icon_url' => $item['image'],
                    'price' => $item['price'],
                    'float_value' => $item['float_value'] ?? null,
                ]);
            }

            // Registrar la transacción en trades
            $trade = Trade::create([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'item_id' => $itemModel->id,
                'item_name' => $item['name'],
                'price' => $item['price'],
                'image' => $item['image'],
                'status' => 'completed', // Estado completado para pagos exitosos
                'payment_method' => 'stripe', // Método de pago
            ]);

            $createdTrades[] = $trade;
        }

        // Limpiar la sesión
        Session::forget('purchased_items');

        // Redirigir a la página de éxito con los trades creados
        return view('checkout-success', [
            'trades' => $createdTrades,
            'items' => $items
        ]);
    }
}