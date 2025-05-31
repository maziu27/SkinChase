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

        // Obtener los datos de múltiples productos desde la solicitud
        $items = $request->input('items');
        $lineItems = [];

        foreach ($items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item['name'],
                        'images' => ["https://steamcommunity-a.akamaihd.net/economy/image/{$item['image']}"],
                    ],
                    'unit_amount' => intval(floatval($item['price']) * 100),
                ],
                'quantity' => 1,
            ];
        }
        
        try {
            // Crear una nueva sesión de checkout con Stripe
            $checkoutSession = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => url('/payment-success'),
                'cancel_url' => url('/checkout-cancel'),
            ]);

            LaravelSession::put('purchased_items', $items);

            return response()->json(['url' => $checkoutSession->url]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}