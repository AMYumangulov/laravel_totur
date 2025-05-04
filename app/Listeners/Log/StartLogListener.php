<?php

namespace App\Listeners\Log;

use App\Events\Log\StartLogEvent;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StartLogListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        Log::create(['model_name' => 'Log',
            'event_name' => 'start log',
        ]);
    }

    /**
     * Handle the event.
     */
    public function handle(StartLogEvent $event): void
    {
        //
    }
}
