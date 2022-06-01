<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{

    public function run()
    {

        User::create([

            "name" => "Andrés Zamora",
            "email" => "admin@integrar.dev",
            "password" => bcrypt("12345678")

        ]);

    }

}