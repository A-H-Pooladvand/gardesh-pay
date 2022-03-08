<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Factory::create();

        Post::factory(50)
            ->create()
            ->each(
                fn(Post $post) => $post->comments()->create(['content' => $faker->sentence])
            );
    }
}
