<?php

namespace App\Models\Traits;

use App\Events\Log\EndLogEvent;
use App\Events\Log\StartLogEvent;
use App\Models\Log;
use Illuminate\Database\Eloquent\Model;

trait HasLog
{
    protected static function bootHasLog()
    {
        static::created(function (Model $model) {
            self::loging($model, 'created');
        });

        static::updated(function (Model $model) {
            self::loging($model, 'updated');
        });

        static::deleted(function (Model $model) {
            self::loging($model, 'deleted');
        });

        static::retrieved(function (Model $model) {
            self::loging($model, 'retrieved');
        });
    }

    protected static function loging(Model $model, $event)
    {
        if ($event == 'deleted') {
            $newAttribute = null;
        }
        elseif ($event == 'updated')
        {
            $newAttribute = json_encode($model->getChanges(), JSON_UNESCAPED_UNICODE);
        }
        else
        {
            $newAttribute = json_encode($model->getAttributes(), JSON_UNESCAPED_UNICODE);
        }

        $oldAttribute = json_encode($model->getOriginal(), JSON_UNESCAPED_UNICODE);

        Log::create(['model_name' => get_class($model),
                    'event_name' => $event,
                    'old_attribute' => $oldAttribute,
                    'new_attribute' =>  $newAttribute
        ]);
    }

}
