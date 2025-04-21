<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeLinkController extends Controller
{
    //funcion para crear enlace para solo un producto
    public function create(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $name = $request->input('name');
        $price = floatval($request->input('price')) * 100; // conversion a centimos
        $image = $request->input('image');

        try {
            $checkoutSession = Session::create([
                'payment_method_types' => ['card'], // permitir solo tarjeta
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