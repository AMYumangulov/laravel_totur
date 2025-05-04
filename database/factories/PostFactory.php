<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'title' => fake()->sentence(5,12),
                'content' => fake()->realTextBetween(300, 1200),
                'profile_id' => Profile::first()->id,
                'is_published' => fake()->boolean,
                'category_id' => Category::inRandomOrder()->first()->id,
                'published_at' => fake()->dateTime,
        ];

    }
}
