<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    protected $table = 'carros';


    protected $fillable = ['id_usuario'];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }


    public function details()
    {
        return $this->hasMany(CartDetail::class, 'id_carrito');
    }
}


