<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{

    public function definition()
    {

        return [
            "image" => "posts/" . $this->faker->image("public/storage/posts", 640, 480, null, false)
        ];

    }

}