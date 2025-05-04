<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function index()
    {
        return CommentResource::collection(Comment::all())->resolve() ;
    }

    public function show(Comment $comment)
    {
        return CommentResource::make( $comment)->resolve();
    }

    public function store()
    {
        $data = [
            'parent' =>2,
            'like' =>2,
            'status'=> 1,
            'author' => 1,
            'post' => 2,
            'content' => 'new comment',
        ];
        return CommentResource::make(CommentService::store($data))->resolve();


    }

    public function update(Comment $comment)
    {
        $data = [
            'content' => 'new updated content',
        ];

        return CommentResource::make(CommentService::update($comment, $data))->resolve();
    }

    public function destroy(Comment $comment)
    {
        $comment = CommentService::destroy($comment);

        return response(
            ['message' => $comment['id'] . 'deleted'],
            Response::HTTP_OK
        );
    }
}
