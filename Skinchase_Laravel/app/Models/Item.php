<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // fillable, se puede asignar y actualizar en masa
    protected $fillable = [
        'asset_id',
        'name',
        'icon_url',
        'price',
        'float_value',
    ];
    // nombre de la tabla
    protected $table = 'items';

    // relación uno a muchos, un item puede estar en muchos trades
    public function trades()
    {
        return $this->hasMany(\App\Models\Trade::class);
    }
}
