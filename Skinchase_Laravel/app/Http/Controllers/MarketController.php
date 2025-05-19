<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MarketController extends Controller
{
    // Método que renderiza la vista principal del mercado
    public function index()
    {
        return view('market');
    }

    // Método que obtiene los datos de la API de CSFloat
    public function fetchData()
    {
        $apiKey = env('CSFLOAT_API_KEY');
        $apiUrl = 'https://csfloat.com/api/v1/listings';

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
            'Content-Type' => 'application/json'
        ])->get($apiUrl);

        if ($response->failed()) {
            return response()->json(['error' => 'No se pudo obtener la información'], 500);
        }

        $data = $response->json();

        if (!isset($data['data']) || !is_array($data['data'])) {
            return response()->json(['error' => 'Invalid API data'], 500);
        }

        foreach ($data['data'] as $product) {
            $item = $product['item'];

            if (!$item || !isset($item['asset_id'], $item['market_hash_name'], $item['icon_url'], $product['price'])) {
                continue;
            }

            // Esto mete las skins en la tabla items mySQL
            Item::updateOrCreate(
                ['asset_id' => $item['asset_id']],
                [
                    'name' => $item['market_hash_name'],
                    'icon_url' => $item['icon_url'],
                    'price' => $product['price'] / 100, // Guardar en euros
                    'float_value' => isset($item['float_value']) ? (float) $item['float_value'] : null,
                ]
            );
        }

       // return response()->json($data);

        // Si todo va bien, devuelve los datos de la API
        return response()->json($response->json());
    }
}
