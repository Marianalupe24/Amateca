<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email    = env('ADMIN_EMAIL', 'admin@amateca.com');
        $password = env('ADMIN_PASSWORD', 'Admin1234!');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name'     => 'Administrador',
                'apellido' => 'Sistema',
                'password' => Hash::make($password),
                'rol'      => 'admin',
            ]
        );
    }
}
