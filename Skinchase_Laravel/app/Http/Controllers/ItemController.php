<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SteamItem;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    //para almacenar skins en la tabla steam_items despues de una venta
    public function store(Request $request){
        $validated = $request->validate([
            //validacion 
            'asset_id' => 'required|string',
            'market_hash_name' => 'required|string',
            'icon_url' => 'required|string',
            'type' => 'nullable|string',
            'tradable' => 'required|boolean',
            'price' => 'required|numeric|min:0.01',
            'tags' => 'nullable|array',
    ]);
    // asigna el id del user autenticado
    $validated['user_id'] = Auth::id();

    SteamItem::create($validated);

    return response()->json(['message' => 'Item listed for sale successfully!'], 201);
    }


public function getUserItems(Request $request)
{
    $userId = $request->query('user_id');
    
    if (!$userId) {
        return response()->json(['error' => 'User ID is required'], 400);
    }

    $items = SteamItem::where('user_id', $userId)
             ->whereNotNull('price') // solo incluye objetos con precio
             ->get()
             ->map(function ($item) {
                 return [
                     'id' => $item->id,
                     'asset_id' => $item->asset_id,
                     'market_hash_name' => $item->market_hash_name,
                     'icon_url' => $item->icon_url,
                     'price' => (float)$item->price, 
                     'tradable' => $item->tradable,
                 ];
             });

    return response()->json($items);
}
}