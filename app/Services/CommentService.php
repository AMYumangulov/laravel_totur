<?php

namespace App\Services;

use App\Jobs\Comment\StoredCommentSendMailJob;
use App\Mail\Comment\StoredCommentMail;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

class CommentService
{
    /**
     * Create a new class instance.
     */
    public static function store(array $data): Comment
    {
        return Comment::create($data);
    }

    public static function storeFromPost(Post $post, array $data): Comment
    {
        $comment = $post->comments()->create($data);

        StoredCommentSendMailJob::dispatch($post, $comment);

        return $comment;
    }

    public static function update($comment, array $data): Comment
    {
        $comment->update($data);
        return $comment;
    }

    public static function destroy($comment): Comment
    {
        $comment->delete();
        return $comment;
    }
}
