<?php

namespace App\Exceptions;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class PostException extends Exception
{
    public function __construct(private Post $post, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     */
    public function report(): void
    {
        Log::channel('posts')->info('post with {id} already exists', ['id' => $this->post->id]);
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): Response
    {
        return response(['message' => $this->getMessage()], $this->getCode());
    }

    public static function ifPostExists(Post $post)
    {
        if (!$post->wasRecentlyCreated) {
            throw new PostException($post,
                'if post exists from PostException',
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
