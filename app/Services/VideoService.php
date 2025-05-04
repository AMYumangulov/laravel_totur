<?php

namespace App\Services;

use App\Models\Video;

class VideoService
{
    public static function store(array $data): Video
    {
        return  Video::create($data);
    }

    public static function update($video, array $data): Video
    {
        $video->update($data);
        return  $video;
    }

    public static function destroy($video): Video
    {
        $video->delete();
        return  $video;
    }
}
