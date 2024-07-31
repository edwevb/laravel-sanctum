<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(2);
        return [
            'title' => rtrim($title, '.'),
            'description' => fake()->paragraphs(3, true),
            'slug' => Str::slug($title, '-'),
            'active' => 1,
            'image' => 'default.jpg'
        ];
    }
}
