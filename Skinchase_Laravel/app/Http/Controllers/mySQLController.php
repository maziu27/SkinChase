<?php

namespace App\Http\Controllers;

use App\Models\Item;

use Illuminate\Http\Request;

class mySQLController extends Controller
{
    //para vista de prueba que saca las mierdas de la base de datos 
    public function index()
    {
        $items = Item::all();
        return view('SQLTest', ['items' => $items]);
    }


    // para devolver JSON
    public function getItemsJson(Request $request)
    {
        $query = Item::query();

        // Filtro por nombre
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filtros por float
        if ($request->filled('floatFrom')) {
            $query->where('float', '>=', $request->floatFrom);
        }

        if ($request->filled('floatTo')) {
            $query->where('float', '<=', $request->floatTo);
        }

        // Filtros por precio
        if ($request->filled('priceFrom')) {
            $query->where('price', '>=', $request->priceFrom);
        }

        if ($request->filled('priceTo')) {
            $query->where('price', '<=', $request->priceTo);
        }

        // Filtros especiales (checkboxes) NO FUNCIONA
        $specials = [];

        if ($request->has('StatTrak')) {
            $specials[] = 'StatTrak';
        }

        if ($request->has('Souvenir')) {
            $specials[] = 'Souvenir';
        }

        if ($request->has('Normal')) {
            $specials[] = 'Normal';
        }

        if (!empty($specials)) {
            $query->whereIn('special_type', $specials);
        }

        // Filtros por stickers
        for ($i = 1; $i <= 5; $i++) {
            $stickerField = 'sticker' . $i;
            if ($request->filled($stickerField)) {
                $query->where("sticker_slot_$i", 'like', '%' . $request->$stickerField . '%');
            }
        }

        // Ordenamiento
        switch ($request->input('sort_by')) {
            case 'lowest_price':
                $query->orderBy('price', 'asc');
                break;
            case 'highest_price':
                $query->orderBy('price', 'desc');
                break;
            case 'most_recent':
                $query->orderBy('created_at', 'desc');
                break;
            case 'expires_soon':
                $query->orderBy('expiration_date', 'asc'); // Asegúrate de tener este campo
                break;
            case 'lowest_float':
                $query->orderBy('float_value', 'asc');
                break;
            case 'highest_float':
                $query->orderBy('float_value', 'desc');
                break;
            //case 'best_deal':
            //  $query->orderBy('deal_score', 'desc'); // campo personalizado hipotético
            //break;
            case 'highest_discount':
                $query->orderBy('discount_percent', 'desc'); // campo personalizado hipotético
                break;

            //case 'float_rank':
            //  $query->orderBy('float_rank', 'asc');
            //break;
            case 'num_bids':
                $query->orderBy('bids_count', 'desc'); // Asegúrate de tener este campo
                break;
        }

        return response()->json($query->get());
    }
}
