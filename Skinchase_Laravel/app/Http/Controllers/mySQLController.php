<?php

namespace App\Http\Controllers;
use App\Models\Item;

use Illuminate\Http\Request;

class mySQLController extends Controller
{
    //para vista de prueba que saca las mierdas de la base de datos 
    public function index(){
        $items = Item::all();
        return view('SQLTest', ['items' => $items]);
    }


    // para devolver JSON
    public function getItemsJson(Request $request){
        $query = Item::query();

    // Filtro por nombre si se proporciona
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    return response()->json($query->get());
        //return response()->json(Item::all());
    }
    
}
