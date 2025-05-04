<?php

namespace App\Jobs\Comment;

use App\Mail\Like\ToggleLikeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ToggleLikeSendMailJod implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Model $model)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->model->user)->send(new ToggleLikeMail($this->model));
    }
}
