<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Trade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        // Recuperar el ID del item desde la sesión
        $itemId = Session::get('item_id');

        // Buscar el item correspondiente
        $item = Item::find($itemId);

        // Verificar que el item existe y el usuario está autenticado
        if ($item && Auth::check()) {
            // Crear el registro de la compra en la tabla 'trades'
            Trade::create([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'item_id' => $item->id,
                'item_name' => $item->name,
            ]);

            // Limpiar el item de la sesión
            Session::forget('item_id');

            // Mostrar la vista de éxito con los datos del item
            return view('checkout-success', [
                'item' => $item,
            ]);
        }

        // Redirigir al inicio si el item no existe o el usuario no está autenticado
        return redirect('/')->with('error', 'Item not found or user not authenticated.');
    }
}