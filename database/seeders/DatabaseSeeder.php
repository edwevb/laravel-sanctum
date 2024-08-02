<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
            UserSeeder::class,
        ]);
        \App\Models\Post::factory()
            // This tells the factory to create a relationship
            ->has(\App\Models\Tag::factory()->count(3))
            ->count(10)
            ->create();


        // $posts->each(function (\App\Models\Post $post) use ($tags) {
        //     $post->tags()->sync(
        //         $tags->random(rand(1, 5))->pluck('id')->toArray()
        //     );
        // });
    }
}
