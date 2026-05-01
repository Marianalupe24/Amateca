<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'autores';

    protected $fillable = [
        'nombre',
        'nacionalidad',
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'id_autor');
    }
}
