<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class FacturaDetalle extends Model
{
    protected $table = 'detalle_factura';


    protected $fillable = [
        'id_factura',
        'id_libro',
        'cantidad',
        'precio_unitario',
    ];


    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }


    public function book()
    {
        return $this->belongsTo(Book::class, 'id_libro');
    }
}
