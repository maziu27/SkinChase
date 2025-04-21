<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;
use Stripe\PaymentLink;

class StripeLinkController extends Controller
{
    public function create(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $name = $request->input('name');
        $price = floatval($request->input('price')) * 100; // Convert to cents
        $image = $request->input('image');

        try {
            // 1. Create product in Stripe
            $stripeProduct = Product::create([
                'name' => $name,
                'images' => ["https://steamcommunity-a.akamaihd.net/economy/image/$image"],
            ]);

            // 2. Create price
            $stripePrice = Price::create([
                'product' => $stripeProduct->id,
                'unit_amount' => intval($price),
                'currency' => 'eur',
            ]);

            // 3. Create payment link
            $paymentLink = PaymentLink::create([
                'line_items' => [
                    ['price' => $stripePrice->id, 'quantity' => 1],
                ],
            ]);

            return response()->json(['url' => $paymentLink->url]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
