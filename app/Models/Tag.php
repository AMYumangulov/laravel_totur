<?php

namespace App\Models;

use App\Models\Traits\HasLog;
use App\Models\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    use HasLog, Loggable;

    public function posts():BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
