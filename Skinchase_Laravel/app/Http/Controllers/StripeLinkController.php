<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as LaravelSession;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeLinkController extends Controller
{
    public function create(Request $request)
    {
        // Configurar la clave secreta de Stripe desde las variables de entorno
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Obtener los datos del producto desde la solicitud
        $name = $request->input('name');  // Nombre del skin
        $price = floatval($request->input('price')) * 100;  // Convertir precio a céntimos para Stripe
        $image = $request->input('image'); // URL de la imagen del skin
        $itemId = $request->input('item_id'); // ID del item

        // Guardar el ID del item en la sesión de Laravel
        LaravelSession::put('item_id', $itemId);
        
        try {
            // Crear una nueva sesión de checkout con Stripe
            $checkoutSession = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $name,
                            'images' => ["https://steamcommunity-a.akamaihd.net/economy/image/$image"],
                        ],
                        'unit_amount' => intval($price),
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => url('/payment-success'),
                'cancel_url' => url('/payment-cancel'),
            ]);

            return response()->json(['url' => $checkoutSession->url]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}