<?php

namespace App\Models;

use App\Models\Traits\HasLog;
use App\Models\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasLog, Loggable;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments():HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, Post::class);
    }
}
