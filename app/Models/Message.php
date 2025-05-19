<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function getIsSelfAttribute(): bool
    {
        return (int) $this->profile_id === (int) auth()->user()->profile->id;
    }
}
