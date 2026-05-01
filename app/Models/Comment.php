<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    protected $table = 'comentarios';


    protected $fillable = [
        'id_usuario',
        'id_libro',
        'comentario',
        'fecha',
    ];


    protected $casts = [
        'fecha' => 'date',
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



