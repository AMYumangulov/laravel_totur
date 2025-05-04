<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $casts = [
      'old_attribute' => 'array',
      'new_attribute' => 'array',
    ];
}
