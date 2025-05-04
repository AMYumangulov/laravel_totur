<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\Profile\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'post_id'   => $this->post_id,
            'content'=> $this->content,
            'profile' => ProfileResource::make($this->profile)->resolve(),
            'subComments' => $this->subComments->count(),
            'parent_id' =>$this->parent_id,
            'published_date' =>$this->published_date,
            'is_liked' => $this->is_liked,
            'liked_by_profiles_count' => $this->liked_by_profiles_count,
        ];
    }
}
