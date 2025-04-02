<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//inventario de Steam del usuario

// Steam API Configuration
$steamApiKey = ""; // Replace with your Steam API key
$steamId = "76561198851093667"; // Replace with the user's Steam ID
$gameId = "730"; // CS2 (Counter-Strike 2) App ID
$inventoryUrl = "https://steamcommunity.com/inventory/$steamId/$gameId/2?l=english&count=5000";

// Fetch inventory
$inventoryUrl = "https://steamcommunity.com/inventory/$steamId/$gameId/2?l=english&count=5000";

// Fetch inventory
$response = file_get_contents($inventoryUrl);
if ($response === false) {
    echo json_encode(["error" => "Failed to fetch inventory."]);
    exit;
}

// Decode JSON response
$inventoryData = json_decode($response, true);

if (isset($inventoryData['assets']) && isset($inventoryData['descriptions'])) {
    $items = [];

    foreach ($inventoryData['assets'] as $asset) {
        foreach ($inventoryData['descriptions'] as $description) {
            if ($asset['classid'] == $description['classid']) {
                $rarity = ""; // Default value
                $weapon_type = ""; // Default value

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

    header('Content-Type: application/json');
    echo json_encode($items);
} else {
    echo json_encode(["error" => "Invalid response from Steam API."]);
}
