<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;


//  Manejo de la creación de enlaces de pago con Stripe

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

        try {
            // Crear una nueva sesión de checkout con Stripe
            $checkoutSession = Session::create([
                'payment_method_types' => ['card'], // Configurar para aceptar solo pagos con tarjeta
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur', // Configurar la moneda en euros
                        'product_data' => [
                            'name' => $name, // Nombre del producto que verá el cliente
                            'images' => ["https://steamcommunity-a.akamaihd.net/economy/image/$image"], // Imagen del skin
                        ],
                        'unit_amount' => intval($price), // Precio en céntimos
                    ],
                    'quantity' => 1, // Cantidad fija de 1 unidad
                ]],
                'mode' => 'payment', // Modo de pago único (no suscripción)
                'success_url' => url('/payment-success'), // URL de redirección si el pago es exitoso
                'cancel_url' => url('/payment-cancel'), // URL de redirección si el pago es cancelado
            ]);

            // Devolver la URL de checkout en formato JSON
            return response()->json(['url' => $checkoutSession->url]);

        } catch (\Exception $e) {
            // Si ocurre algún error, devolver el mensaje de error con código 500
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}