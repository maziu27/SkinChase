<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class SteamController extends Controller
{
    public function index()
    {
        return view('market');
    }

    // para obtener los items de un trade_link de steam
    public function fetchSteamInventory()
    {

        // obtiene el inventario de steam que el usuario puso en la creacion de la cuenta
        $tradeLink = Auth::user()->trade_link;

        //extrae el partner ID desde el enlace con un regex
        preg_match('/partner=(\d+)/', $tradeLink, $matches);
        if (!isset($matches[1])) {
            return response()->json(['error' => 'Invalid Steam trade link'], 400);
        }
        //convierte el partner ID a steamID64.  
        $partnerId = $matches[1];
        $steamid64 = bcadd($partnerId, '76561197960265728');

        //api de steam, 730 siendo Counter-Strike2
        $apiUrl = "https://steamcommunity.com/inventory/{$steamid64}/730/2";

        // petición HTTPS a steam
        $response = Http::get($apiUrl);

        // error de inventario
        if ($response->failed()) {
            return response()->json(['error' => 'Unable to access your Steam inventory. Try again later'], 500);
        }

        $inventory = $response->json();
        // verifica si existen arrays assets y descriptions
        if (!isset($inventory['assets'], $inventory['descriptions'])) {
            return response()->json(['error' => 'Empty inventory'], 500);
        }
        //almacenar los items en el array
        $items = []; 
        //itera todos los items del inventario
        foreach ($inventory['assets'] as $asset) {
            $desc = collect($inventory['descriptions'])->first(function ($d) use ($asset) {
                return $d['classid'] == $asset['classid'] && $d['instanceid'] == $asset['instanceid'];
            });

            // si encuentra la descripción guarda todos los datos
            if ($desc) {
                $items[] = [
                    'asset_id' => $asset['assetid'],
                    'market_hash_name' => $desc['market_hash_name'],
                    'icon_url' => 'https://steamcommunity-a.akamaihd.net/economy/image/' . $desc['icon_url'],
                    'type' => $desc['type'] ?? null,
                    'tradable' => $desc['tradable'] ?? false,
                    //recorte a solo 5 tags porque ocupaban mucho espacio en la vista
                    'tags' => array_slice($desc['tags'] ?? [], 0, 5),
                ];
            }
        }
        // devuelve los items en un JSON.
        return response()->json($items);
    }

}