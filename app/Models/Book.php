<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    use HasFactory;


    protected $table = 'libros';


    protected $fillable = [
        'titulo',
        'descripcion',
        'ISBN',
        'precio',
        'stock',
        'idioma',
        'imagen_portada',
        'fecha_registro',
        'activo',
        'id_autor',
        'id_categoria',
    ];


    protected $casts = [
        'activo'         => 'boolean',
        'fecha_registro' => 'date',
        'precio'         => 'decimal:2',
    ];


    public function author()
    {
        return $this->belongsTo(Author::class, 'id_autor');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'id_categoria');
    }


    public function scopeActivos(Builder $query): Builder
    {
        return $query->where('activo', true);
    }


    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'id_libro')->orderByDesc('created_at');
    }


}



