<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{

    public function definition()
    {

        $category = $this->faker->unique()->word(20);

        return [
            "category" => $category,
            "url" => Str::slug($category)
        ];

    }

}