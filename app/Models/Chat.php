<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
