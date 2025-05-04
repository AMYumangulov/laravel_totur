<?php

namespace App\Models;

use App\Models\Traits\HasLog;
use App\Models\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasLog, Loggable;

    protected $withCount = ['likedByProfiles'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function subComments():hasMany
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id')->latest();
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }


    public function likedByProfiles(): MorphToMany
    {
        return $this->morphToMany(Profile::class, 'likeable');
    }

    public function image():MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function profile():BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function user():BelongsTo
    {
        return $this->profile->user();
    }

    public function getPublishedDateAttribute():string
    {
        return $this->created_at->diffForHumans();
    }

    public function getIsLikedAttribute(): bool
    {
        return $this->likedByProfiles->contains('id', auth()->user()->profile->id);
    }
}
