<?php

namespace App\Listeners\Log;

use App\Events\Log\EndLogEvent;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EndLogListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

        Log::create(['model_name' => 'Log',
            'event_name' => 'end log',
        ]);
    }

    /**
     * Handle the event.
     */
    public function handle(EndLogEvent $event): void
    {
        //
    }
}
