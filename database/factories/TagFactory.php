<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{

    public function definition()
    {

        $tag = $this->faker->unique()->word(20);

        return [
            "tag" => $tag,
            "url" => Str::slug($tag)
        ];

    }

}