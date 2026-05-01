<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Novela',                      'descripcion' => 'Obras de ficción en prosa de larga extensión'],
            ['nombre' => 'Cuento',                      'descripcion' => 'Narraciones breves de ficción'],
            ['nombre' => 'Poesía',                      'descripcion' => 'Composiciones líricas en verso o prosa poética'],
            ['nombre' => 'Ensayo',                      'descripcion' => 'Análisis y reflexiones sobre temas variados'],
            ['nombre' => 'Historia',                    'descripcion' => 'Obras sobre eventos y personajes históricos'],
            ['nombre' => 'Ciencia y Tecnología',        'descripcion' => 'Divulgación científica y tecnológica'],
            ['nombre' => 'Literatura Infantil',         'descripcion' => 'Lecturas para niños y primeros lectores'],
            ['nombre' => 'Literatura Juvenil',          'descripcion' => 'Lecturas para adolescentes y jóvenes adultos'],
            ['nombre' => 'Terror y Suspenso',           'descripcion' => 'Obras de miedo, misterio e intriga'],
            ['nombre' => 'Ciencia Ficción y Fantasía',  'descripcion' => 'Mundos alternativos y tecnología futura'],
            ['nombre' => 'Romance',                     'descripcion' => 'Historias de amor y relaciones sentimentales'],
            ['nombre' => 'Autoayuda',                   'descripcion' => 'Guías para el desarrollo personal y bienestar'],
        ];

        foreach ($categorias as $data) {
            Category::firstOrCreate(['nombre' => $data['nombre']], $data);
        }
    }
}
