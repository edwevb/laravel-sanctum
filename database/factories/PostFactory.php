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
            'title' => Str::title(rtrim($title, '.')),
            'user_id' => fake()->numberBetween(1, 3),
            'description' => fake()->paragraphs(3, true),
            'slug' => Str::slug($title, '-'),
            'published' => fake()->numberBetween(0, 1),
            'image' => 'default.jpg'
        ];
    }

    // public function configure()
    // {
    //     return $this->afterCreating(function (\App\Models\Post $post) {
    //         // Will create 3 tasks for each new post
    //         \App\Models\Tag::factory()->count(3)->create([
    //             'post_id' => $post->id,
    //         ]);
    //     });
    // }
}
