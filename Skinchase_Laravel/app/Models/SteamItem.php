<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SteamItem extends Model{
    // fillable, se puede asignar y actualizar en masa
    protected $fillable = [
        'asset_id',
        'market_hash_name',
        'icon_url',
        'type',
        'tradable',
        'price',
        'tags',
        'user_id',
    ];

    // Para almacenar las etiquetas como un array
    protected $casts = [
        'tags' => 'array', 
    ];

    // apunta a la tabla steam_items
    protected $table = 'steam_items';

    // relación muchos SteamItems pertenecen a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}