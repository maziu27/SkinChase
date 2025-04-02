<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MarketController extends Controller
{
    public function index()
    {
        return view('market');
    }

    public function fetchData()
    {
        $apiKey = env('CSFLOAT_API_KEY'); // Clave de API desde .env
        $apiUrl = 'https://csfloat.com/api/v1/listings';

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
            'Content-Type' => 'application/json'
        ])->get($apiUrl);

        if ($response->failed()) {
            return response()->json(['error' => 'No se pudo obtener la información'], 500);
        }

        return response()->json($response->json());
    }
}
