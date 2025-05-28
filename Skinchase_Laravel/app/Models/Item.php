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

    protected $table = 'items';

    public function trades()
    {
        return $this->belongsToMany(User::class, 'trades');
    }
}
