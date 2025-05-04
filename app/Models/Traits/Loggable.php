<?php


namespace App\Models\Traits;


use App\Logging\CustomizeFormatter;
use App\Logging\DynamicModelLogChannel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Exception;

trait Loggable
{
    protected static function bootLoggable()
    {
        static::created(function (Model $model) {

            self::log($model, 'created', json_encode($model->getAttributes()));

        });

        static::updated(function (Model $model) {
            self::log($model, 'updated', json_encode($model->getChanges()));
        });

        static::deleted(function (Model $model) {
            self::log($model, 'deleted');
        });

        static::retrieved(function (Model $model) {
            self::log($model, 'retrieved');
        });
    }

    protected static function log(Model $model, string $event, string $message = null, string $level = 'info'): void
    {
        $channel = 'dynamic_model_logs';
        $modelName = strtolower(class_basename($model));

        Log::build([
            'driver' => 'custom',
            'via' => DynamicModelLogChannel::class,
            'model' => $modelName,
            'level' => $level,
            'event' => $event
        ])->$level( $message ?? 'ID:'.$model->getKey());

    }


}
