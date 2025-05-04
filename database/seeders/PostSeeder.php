<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$posts = Post::factory(10)->create();

        $posts = Post::factory(10)
            ->has(Comment::factory()
                        ->count(3),'comments')
            ->create();


        $tags = Tag::all();
        foreach ($posts as $post) {
            $post->tags()->syncWithoutDetaching($tags->random(fake()->numberBetween(1,5))->pluck('id'));
        }

        $profiles = Profile::all();
        foreach ($posts as $post) {
            $post->likedByProfiles()->syncWithoutDetaching($profiles->random(fake()->numberBetween(1,2))->pluck('id'));
        }
      //  $comments = Comment::all();

        $comments = Comment::all();
        foreach ($comments as $comment) {
            $comment->likedByProfiles()->syncWithoutDetaching($profiles->random(fake()->numberBetween(1,2))->pluck('id'));
        }

         Comment::factory()
                  ->count(3)
                  ->forComment()
                  ->create();

    }
}
