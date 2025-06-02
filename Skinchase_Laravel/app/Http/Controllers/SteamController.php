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

    public function fetchSteamInventory()
    {
        $tradeLink = Auth::user()->trade_link;

        preg_match('/partner=(\d+)/', $tradeLink, $matches);
        if (!isset($matches[1])) {
            return response()->json(['error' => 'Enlace de intercambio inválido'], 400);
        }
        $partnerId = $matches[1];
        $steamid64 = bcadd($partnerId, '76561197960265728');

        $apiUrl = "https://steamcommunity.com/inventory/{$steamid64}/730/2";

        $response = Http::get($apiUrl);

        if ($response->failed()) {
            return response()->json(['error' => 'No se pudo acceder al inventario de Steam'], 500);
        }

        $inventory = $response->json();

        if (!isset($inventory['assets'], $inventory['descriptions'])) {
            return response()->json(['error' => 'Inventario inválido o vacío'], 500);
        }

        $items = [];
        foreach ($inventory['assets'] as $asset) {
            $desc = collect($inventory['descriptions'])->first(function ($d) use ($asset) {
                return $d['classid'] == $asset['classid'] && $d['instanceid'] == $asset['instanceid'];
            });

            if ($desc) {
                $items[] = [
                    'asset_id' => $asset['assetid'],
                    'market_hash_name' => $desc['market_hash_name'],
                    'icon_url' => 'https://steamcommunity-a.akamaihd.net/economy/image/' . $desc['icon_url'],
                    'type' => $desc['type'] ?? null,
                    'tradable' => $desc['tradable'] ?? false,
                    'tags' => array_slice($desc['tags'] ?? [], 0, 5),
                ];
            }
        }

        return response()->json($items);
    }

}