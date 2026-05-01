<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $email    = env('EMPLOYEE_EMAIL', 'empleado@amateca.com');
        $password = env('EMPLOYEE_PASSWORD', 'Empleado1234!');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name'     => 'Empleado',
                'apellido' => 'General',
                'password' => Hash::make($password),
                'rol'      => 'empleado',
            ]
        );
    }
}
