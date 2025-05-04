<?php

namespace App\Http\Resources\Statistic;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'post_count' => $this->post_count,
            'comment_count' => $this->comment_count,
            'like_count' => $this->like_count,
            'post_like_count' => $this->post_like_count,
            'comment_like_count' => $this->comment_like_count,
            'view_count' => $this->view_count,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
        ];
    }
}
