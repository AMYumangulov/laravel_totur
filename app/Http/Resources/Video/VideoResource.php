<?php

namespace App\Http\Resources\Video;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'   => $this->id,
            'title'=> $this->title,
            'video_path' => $this->video_path,
            'description'=> $this->description,
            'profile_id'=> $this->profile_id,
        ];
    }
}
