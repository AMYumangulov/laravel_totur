<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Like;

class LikeService
{
    /**
     * Create a new class instance.
     */
    public static function store(array $data): Like
    {
        return  Like::create($data);
    }

    public static function update($like, array $data): Like
    {
        $like->update($data);
        return  $like;
    }

    public static function destroy($like ): Like
    {
        $like->delete();
        return  $like;
    }
}
