<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostService
{
    /**
     * Create a new class instance.
     */
    public static function store(array $data)
    {
        try {
            DB::beginTransaction();
            $post = Post::create($data['post']);

            if (isset($data['image_path'])) {
                $post->image()->create(['path' => $data['image_path']]);
            }

//            if (isset($data['tag_titles'])) {
//                $post->tags()->attach(TagService::storeBatch($data['tag_titles']));
//            }
            $post->tags()->attach(TagService::storeBatch($data['tag_titles']));

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
        }

        return $post;
    }

    public static function update(Post $post, array $data): Post
    {
        $post->update($data['post']);

        if (isset($data['image_path'])) {
            Storage::disk('public')->delete($post->image->path);
            $post->image()->delete();
            $post->image()->create(['path' => $data['image_path']]);
        }

        $post->tags()->sync(TagService::storeBatch($data['tag_titles']));
//        try {
//            DB::beginTransaction();
//            $post->update($data['post']);
//
//            if (isset($data['image_path'])) {
//                $post->image()->update(['path' => $data['image_path']]);
//            }
//
//            $post->tags()->sync(TagService::storeBatch($data['tag_titles']));
//
//            DB::commit();
//
//        } catch (\Exception $exception) {
//            DB::rollBack();
//        }

        return $post;
    }

    public static function destroy($post): Post
    {
        $post->delete();
        return $post;
    }
}
