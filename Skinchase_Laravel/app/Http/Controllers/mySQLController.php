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
        return view('market', ['items' => $items]);
    }


    // para devolver JSON
    public function getItemsJson(Request $request)
    {
        $query = Item::query();

        // Filtro por nombre
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filtros por precio
        if ($request->filled('priceFrom')) {
            $query->where('price', '>=', $request->priceFrom);
        }

        if ($request->filled('priceTo')) {
            $query->where('price', '<=', $request->priceTo);
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
            case 'lowest_float':
                $query->orderBy('float_value', 'asc');
                break;
            case 'highest_float':
                $query->orderBy('float_value', 'desc');
                break;
        }

        return response()->json($query->get());
    }
}
