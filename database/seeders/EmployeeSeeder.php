<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Employee;

class EmployeeSeeder extends Seeder
{

    public function run()
    {

        Employee::insert(["names" => "Andrés Zamora", "job" => "Programador Web"]);

        Employee::insert(["names" => "Lina Suarez", "job" => "Publicista"]);

        Employee::insert(["names" => "Diana Salinas", "job" => "Contadora"]);

        Employee::insert(["names" => "Juana Castro", "job" => "Administradora"]);

        Employee::insert(["names" => "Jenny Puerto", "job" => "Diseñadora"]);

    }

}