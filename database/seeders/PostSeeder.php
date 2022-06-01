<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Post;
use App\Models\Image;

class PostSeeder extends Seeder
{

    public function run()
    {

        Post::factory(20)->create()->each(function(Post $post)
        {

            Image::factory(1)->create(["imageable_id" => $post->id, "imageable_type" => Post::class]);

            $post->tags()->attach([
                rand(1, 3),
                rand(4, 6),
                rand(7, 8)
            ]);

        });

    }

}