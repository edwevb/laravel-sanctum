<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{

    public function definition(): array
    {
        $title = fake()->word();
        return [
            'title' => Str::title($title),
            'slug' => Str::slug($title, '-'),
        ];
    }
}
