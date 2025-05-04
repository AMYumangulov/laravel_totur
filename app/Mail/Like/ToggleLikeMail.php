<?php

namespace App\Mail\Like;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ToggleLikeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private Model $model)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Toggle Like',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $className = class_basename($this->model);
        $content = '';
        if ($className == 'Post'){
            $content = 'На ваш пост: ' . $this->model->title;
        } elseif ($className == 'Comment') {
            $content = 'На ваш комментарий: ' . $this->model->content;
        }

        $content = $content . ' поставлен лайк ';

        return new Content(
            view: 'mail.like.toggle_like',
            with:  [
                'content' => $content
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
