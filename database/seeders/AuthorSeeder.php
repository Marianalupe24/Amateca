<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $autores = [
            ['nombre' => 'Gabriel García Márquez',   'nacionalidad' => 'Colombiano'],
            ['nombre' => 'Isabel Allende',            'nacionalidad' => 'Chilena'],
            ['nombre' => 'Mario Vargas Llosa',        'nacionalidad' => 'Peruano'],
            ['nombre' => 'Jorge Luis Borges',         'nacionalidad' => 'Argentino'],
            ['nombre' => 'Pablo Neruda',              'nacionalidad' => 'Chileno'],
            ['nombre' => 'Julio Cortázar',            'nacionalidad' => 'Argentino'],
            ['nombre' => 'Juan Rulfo',                'nacionalidad' => 'Mexicano'],
            ['nombre' => 'Carlos Fuentes',            'nacionalidad' => 'Mexicano'],
            ['nombre' => 'Laura Esquivel',            'nacionalidad' => 'Mexicana'],
            ['nombre' => 'Roberto Bolaño',            'nacionalidad' => 'Chileno'],
            ['nombre' => 'Paulo Coelho',              'nacionalidad' => 'Brasileño'],
            ['nombre' => 'Alfredo Bryce Echenique',   'nacionalidad' => 'Peruano'],
            ['nombre' => 'J.K. Rowling',              'nacionalidad' => 'Británica'],
            ['nombre' => 'Stephen King',              'nacionalidad' => 'Estadounidense'],
            ['nombre' => 'Haruki Murakami',           'nacionalidad' => 'Japonés'],
        ];

        foreach ($autores as $data) {
            Author::firstOrCreate(['nombre' => $data['nombre']], $data);
        }
    }
}
