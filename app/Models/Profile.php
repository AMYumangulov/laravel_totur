<?php

namespace App\Models;

use App\Models\Traits\HasLog;
use App\Models\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasLog, Loggable;

    protected static function booted():void
    {
        static::created(function (Profile $profile){
            Log::create(['model_name' => 'профиля',
                'event_name' => 'tesst',
                'old_attribute' => 'tesst',
                'new_attribute' =>  'tesst'
            ]);
        });
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likedPosts():MorphToMany
    {
        return $this->morphedByMany(Post::class, 'likeable');
    }

    public function likedComments():MorphToMany
    {
        return $this->morphedByMany(Comment::class, 'likeable');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }


}
