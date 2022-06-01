<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class PostFactory extends Factory
{

    public function definition()
    {

        $post = $this->faker->unique()->word(20);

        return [
            "title" => $post,
            "url" => Str::slug($post),
            "resume" => $this->faker->text(100),
            "content" => $this->faker->text(1000),
            "user_id" => User::all()->random()->id,
            "category_id" => Category::all()->random()->id
        ];

    }

}