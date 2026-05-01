<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class CartDetail extends Model
{
    protected $table = 'detalle_carro';


    protected $fillable = [
        'id_carrito',
        'id_libro',
        'cantidad',
        'precio_unitario',
    ];


    protected $casts = [
        'precio_unitario' => 'decimal:2',
    ];


    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_carrito');
    }


    public function book()
    {
        return $this->belongsTo(Book::class, 'id_libro');
    }
}


