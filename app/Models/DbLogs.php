<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DbLogs extends Model
{
    public function dbQuery():HasMany
    {
        return $this->hasMany(DbLogQuery::class, 'pid');
    }
}
