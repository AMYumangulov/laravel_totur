<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Tag;

class TagService
{
    /**
     * Create a new class instance.
     */
    public static function store(array $data): Tag
    {
        return  Tag::create($data);
    }

    public static function storeBatch(array $data): array
    {
        $tagIds = [];
        foreach ($data as $tag){
            $tagIds[] = Tag::firstOrCreate(['title' => $tag])->id;
        }
        return  $tagIds;
    }

    public static function update($tag, array $data): Tag
    {
        $tag->update($data);
        return  $tag;
    }

    public static function destroy($tag ): Tag
    {
        $tag->delete();
        return  $tag;
    }
}
