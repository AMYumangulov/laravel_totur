<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = [
            'name' => 'user',
            'password' => Hash::make(123123123),
            'email' => 'user@mail.ru'
        ];

        $user = User::firstOrCreate([
            'email' => $user['email']
        ],
            $user);

        $this->call([
            ProfileSeeder::class,
            TagSeeder::class,
            CategorySeed::class,
            PostSeeder::class,
            //CommentSeeder::class,
        ]);

        $profiles = Profile::all();
        $comments = Comment::all();
        $posts = Post::all();
        $tags = Tag::all();
        $users = User::all();

        foreach ($comments as $comment) {
            $comment->likedByProfiles()->detach($profiles->random(fake()->numberBetween(1, 2))->pluck('id'));
        }

        foreach ($posts as $post) {
            $post->tags()->detach();

            $post->update([
                'title' => 'updated title'
            ]);


        }

        foreach ($profiles as $profile) {
            $profile->update([
                'name' => 'updated name'
            ]);
        }

        foreach ($comments as $comment) {
            $comment->update([
                'content' => 'updated content'
            ]);
        }
        foreach ($tags as $tag) {
            $tag->update([
                'title' => 'updated title'
            ]);

            $tag->posts()->detach();
        }

        foreach ($users as $user) {
            $user->update([
                'name' => 'updated name'
            ]);
        }


        foreach ($comments as $comment) {
            $comment->delete();
        }

        foreach ($posts as $post) {
           $post->delete();
        }

        foreach ($tags as $tag) {
            $tag->delete();
        }

        foreach ($profiles as $profile) {
            $profile->delete();
        }


    }
}
