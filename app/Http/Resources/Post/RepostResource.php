<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Profile\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepostResource extends JsonResource
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
            'short_content'=> $this->short_content,
            'content'=> $this->content,
            'category'=> CategoryResource::make($this->category)->resolve(),
            'profile'=> ProfileResource::make($this->profile)->resolve(),
            'image_url' => $this->image_url,
            'published_at' => $this->published_date,
            'is_liked' => $this->is_liked,
            'liked_by_profiles_count' => $this->liked_by_profiles_count,
            'comment_count' => $this->comment_count,

        ];
    }
}
