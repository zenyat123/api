<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{

    public function run()
    {

        Storage::deleteDirectory("posts");
        Storage::makeDirectory("posts");

        $this->call(UserSeeder::class);

        Category::factory(5)->create();
        Tag::factory(8)->create();

        $this->call(PostSeeder::class);

    }

}