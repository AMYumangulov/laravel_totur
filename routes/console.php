<?php

use Illuminate\Support\Facades\Schedule;


Schedule::command('collect-stats')->dailyAt('12:00');
