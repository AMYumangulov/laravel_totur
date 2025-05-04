<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DbLogQuery extends Model
{
    public function dbLog():BelongsTo
    {
        return  $this->belongsTo(DbLogs::class, 'pid');
    }
}
