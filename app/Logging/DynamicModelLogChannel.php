<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class DynamicModelLogChannel
{
    public function __invoke(array $config): Logger
    {
        //dd($config);
        // Определяем имя файла для логов
        $modelName = $config['model'] ?? 'default';
        $event = $config['event'] ?? 'default';
        $logPath = storage_path("logs/{$modelName}/{$event}.log");

        // Создаем логгер
        $logger = new Logger('dynamic_model_logs');
        $handler = new StreamHandler($logPath, $config['level'] ?? 'debug');

        // Настраиваем формат логов
        $formatter = new LineFormatter(
            '[%datetime%] %message%' . PHP_EOL,
            'Y-m-d H:i:s',
        );
        $handler->setFormatter($formatter);

        $logger->pushHandler($handler);

        return $logger;

    }
}
