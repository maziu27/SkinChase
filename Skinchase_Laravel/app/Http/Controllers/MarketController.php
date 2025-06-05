<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MarketController extends Controller
{
    public function index()
    {
        return view('market');
    }

    // Método que obtiene los datos de la API de CSFloat
    public function fetchData()
    {
        //variable que coge la clave en el archivo .env
        $apiKey = env('CSFLOAT_API_KEY');
        $apiUrl = 'https://csfloat.com/api/v1/listings';

        //realiza un GET a la API con la clave
        $response = Http::withHeaders([
            'Authorization' => $apiKey,
            'Content-Type' => 'application/json'
        ])->get($apiUrl);

        //para fallo de la petición
        if ($response->failed()) {
            return response()->json(['error' => 'Error 500: information not obtainable'], 500);
        }

        $data = $response->json();
        //si data no existe o no es un array devuelve error
        if (!isset($data['data']) || !is_array($data['data'])) {
            return response()->json(['error' => 'Invalid API data'], 500);
        }
        // iterar sobre todos los productos que saca la api
        foreach ($data['data'] as $product) {
            $item = $product['item'];

            if (!$item || !isset($item['asset_id'], $item['market_hash_name'], $item['icon_url'], $product['price'])) {
                continue;
            }

            // Esto mete las skins en la tabla items
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

        // Si todo va bien, devuelve los datos de la API
        return response()->json($response->json());
    }
}
