<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Factura extends Model
{
    protected $table = 'facturas';


    protected $fillable = [
        'id_usuario',
        'total',
        'estado',
        'stripe_payment_id',
        'fecha',
    ];


    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'total' => 'decimal:2',
        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }


    public function detalles()
    {
        return $this->hasMany(FacturaDetalle::class, 'id_factura');
    }
}

