<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
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

    protected $table = 'trades';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}