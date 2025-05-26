<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'asset_id',
        'name',
        'icon_url',
        'price',
        'float_value',
    ];

    public function trade()
{
    return $this->belongsTo(Trade::class);
}
}
