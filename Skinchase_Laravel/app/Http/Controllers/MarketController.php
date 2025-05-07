<?php

namespace App\Http\Controllers;

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
        // Obtiene la clave de API desde el archivo .env
        $apiKey = env('CSFLOAT_API_KEY');
        
        // URL de la API de CSFloat
        $apiUrl = 'https://csfloat.com/api/v1/listings';

        // Hace una petición GET a la API con los headers necesarios
        $response = Http::withHeaders([
            'Authorization' => $apiKey,
            'Content-Type' => 'application/json'
        ])->get($apiUrl);

        // Si la petición falla, devuelve un error
        if ($response->failed()) {
            return response()->json(['error' => 'No se pudo obtener la información'], 500);
        }

        // Si todo va bien, devuelve los datos de la API
        return response()->json($response->json());
    }
}