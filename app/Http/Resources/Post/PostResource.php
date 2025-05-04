<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Profile\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'content'=> $this->content,
            'category'=> CategoryResource::make($this->category)->resolve(),
            'profile'=> ProfileResource::make($this->profile)->resolve(),
            'image_url' => $this->image_url,
            'published_at' => $this->published_at ? \Carbon\Carbon::parse($this->published_at)->format('Y-m-d H:i') : null,
            'category_id' => $this->category_id,

        ];
    }
}
