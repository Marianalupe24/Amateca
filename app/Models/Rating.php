<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Rating extends Model
{
    protected $table = 'calificaciones';


    protected $fillable = [
        'id_usuario',
        'id_libro',
        'estrellas',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }


    public function book()
    {
        return $this->belongsTo(Book::class, 'id_libro');
    }
}



