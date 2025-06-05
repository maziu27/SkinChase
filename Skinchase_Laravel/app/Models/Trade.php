<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    // fillable, se puede asignar y actualizar en masa
    protected $fillable = [
        'user_id',
        'user_name',
        'item_id',
        'item_name',
        'price',
        'image',
        'status',
        'payment_method'
    ];

    // apunta a la tabla trades
    protected $table = 'trades';

    // relación muchos trades pertenecen a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relación muchos trades pertenecen a un item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}