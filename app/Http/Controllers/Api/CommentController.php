<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Comment\StoreRequest;
use App\Http\Requests\Api\Comment\UpdateRequest;
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

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        return CommentResource::make(CommentService::store($data))->resolve();
    }

    public function update(UpdateRequest $request,Comment $comment)
    {
        $data = $request->validated();
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
