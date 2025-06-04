<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SteamItem extends Model
{
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

    protected $casts = [
        'tags' => 'array', // Para almacenar las etiquetas como un array
    ];

    protected $table = 'steam_items';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}