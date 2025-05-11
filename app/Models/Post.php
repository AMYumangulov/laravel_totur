<?php

namespace App\Models;

use App\Models\Traits\hasFilter;
use App\Models\Traits\HasLog;
use App\Models\Traits\Loggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasLog, Loggable;
    use HasFilter;

    protected $withCount = ['likedByProfiles', 'comments'];

    protected static function booted(): void
    {

        $clearCache = function () {
            DB::table('cache')
                ->where('key', 'ilike', 'posts_%')
                ->delete();
        };

        static::created($clearCache);
        static::updated($clearCache);
        static::deleted($clearCache);

    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function user(): BelongsTo
    {
        return $this->profile->user();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function likedByProfiles(): MorphToMany
    {
        return $this->morphToMany(Profile::class, 'likeable', 'likeables')->withTimestamps();
    }

    public function likes(): MorphToMany
    {
        return $this->morphToMany(Profile::class, 'likeable', 'likeables');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('parent_id', '=', null)->latest();
    }

    public function repostedPost(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function repostPosts(): HasMany
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return Storage::disk('public')->url($this->image->path);
        }

        return null;
    }

    public function getShortContentAttribute()
    {
        if (!$this->content) return null;

        $length = 250;
        if (mb_strlen($this->content, 'UTF-8') > $length) {
            return mb_substr($this->content, 0, $length, 'UTF-8') . '...';
        }

        return $this->content;
    }

    public function getTagsAsString(): string
    {
        return $this->tags->pluck('title')->implode(',');
    }

    public function getIsLikedAttribute(): bool
    {
        return $this->likedByProfiles->contains('id', auth()->user()->profile->id);
    }

    public function getPublishedDateAttribute():string
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }

    public function getCommentCountAttribute()
    {
        return $this->comments->count();
    }


}
