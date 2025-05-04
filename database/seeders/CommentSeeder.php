<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = Comment::factory(8)->create();
        $profiles = Profile::all();
        foreach ($comments as $comment) {
            $comment->likedByProfiles()->syncWithoutDetaching($profiles->random(fake()->numberBetween(1,2))->pluck('id'));
        }
    }
}
