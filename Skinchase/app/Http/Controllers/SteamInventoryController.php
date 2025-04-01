<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SteamInventoryController extends Controller
{
    public function fetchInventory()
    {
        $steamApiKey = ""; // Replace with your Steam API key
        $steamId = "76561198851093667"; // Replace with the user's Steam ID
        $gameId = "730"; // CS2 (Counter-Strike 2) App ID
        $inventoryUrl = "https://steamcommunity.com/inventory/$steamId/$gameId/2?l=english&count=5000";

        // Fetch inventory
        $response = file_get_contents($inventoryUrl);
        if ($response === false) {
            return response()->json(["error" => "Failed to fetch inventory."]);
        }

        // Decode JSON response
        $inventoryData = json_decode($response, true);

        if (isset($inventoryData['assets']) && isset($inventoryData['descriptions'])) {
            $items = [];

            foreach ($inventoryData['assets'] as $asset) {
                foreach ($inventoryData['descriptions'] as $description) {
                    if ($asset['classid'] == $description['classid']) {
                        $rarity = "Unknown"; // Default value
                        $weapon_type = "Unknown"; // Default value

                        // Look for rarity tag and weapon type tag
                        foreach ($description['tags'] as $tag) {
                            if (isset($tag['category']) && $tag['category'] == 'Rarity') {
                                $rarity = isset($tag['name']) ? $tag['name'] : "Unknown"; // Use 'name' if it exists
                            }
                            if (isset($tag['category']) && $tag['category'] == 'Weapon') {
                                $weapon_type = isset($tag['name']) ? $tag['name'] : "Unknown"; // Use 'name' if it exists
                            }
                        }

                        $items[] = [
                            'name' => $description['market_hash_name'],
                            'icon_url' => "https://community.cloudflare.steamstatic.com/economy/image/" . $description['icon_url'],
                            'rarity' => $rarity,  // Rarity such as "Mil-Spec"
                            'weapon_type' => $weapon_type, // Weapon type such as "Pistol"
                        ];
                        break;
                    }
                }
            }
            //mostrar items en la vista de inventario
            return view('inventory', ['items'=>$items]);
        } else {
            return view('inventory',["error" => "Invalid response from Steam API."]);
        }
    }
}
