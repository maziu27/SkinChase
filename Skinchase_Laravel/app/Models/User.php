<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // fillable, se puede asignar y actualizar en masa
    protected $fillable = [
        'name',
        'email',
        'password',
        'trade_link',
        'profile_picture',
    ];

    // oculta la contraseña y el token
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }

    public function steamItems()
    {
        return $this->hasMany(SteamItem::class);
    }
}