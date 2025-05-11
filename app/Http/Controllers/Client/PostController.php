<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Comment\IndexRequest;
use App\Http\Requests\Client\Post\RepostRequest;
use App\Http\Requests\Client\Post\StoreCommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Post\PostVueResource;
use App\Jobs\Comment\ToggleLikeSendMailJod;
use App\Models\Comment;
use App\Models\Post;
use App\Services\CommentService;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $post = PostVueResource::make($post)->resolve();

        return inertia('Client/Post/Show', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function toggleLike(Post $post)
    {
        $res = $post->likedByProfiles()->toggle(auth()->user()->profile->id);
        $post = Post::find($post->id);
        $likeCount = $post->liked_by_profiles_count;

        if (count($res['attached']) > 0) {
            ToggleLikeSendMailJod::dispatch($post);
        }
        return response()->json([
            'is_liked' => count($res['attached']) > 0,
            'like_count' => $likeCount
        ]);
    }

    public function toggleLikeComment(Comment $comment)
    {
        $res = $comment->likedByProfiles()->toggle(auth()->user()->profile->id);
        $commentLikeCount =  Comment::find($comment->id)->liked_by_profiles_count;

        if (count($res['attached']) > 0) {
            ToggleLikeSendMailJod::dispatch($comment);
        }

        return response()->json([
            'is_liked' => count($res['attached']) > 0,
            'like_count' => $commentLikeCount
        ]);
    }

    public function storeComment(StoreCommentRequest $request, Post $post)
    {
        $data = $request->validationData();

        return CommentResource::make(CommentService::storeFromPost($post, $data))->resolve();
    }

    public function indexComment(IndexRequest $request, Post $post)
    {
        $data = $request->validationData();

        $comments = $post->comments()->paginate($data['per_page'],
                                                '*',
                                                'page',
                                                $data['page']);

        return CommentResource::collection($comments);
    }

    public function childComment(Comment $comment)
    {
        return CommentResource::collection($comment->subComments)->resolve();
    }

    public function showComment(Comment $comment)
    {
        return CommentResource::make($comment)->resolve();
    }

    public function countComment(Post $post)
    {
        return $post->comments->count();
    }

    public function repost(Post $post, RepostRequest $request)
    {
        $data = $request->validationData();
        $post = $post->repostPosts()->create($data);

        return PostVueResource::make($post)->resolve();
    }


}
