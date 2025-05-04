<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comment\StoreRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CommentController extends Controller
{
    public function index()
    {
        $comments = CommentResource::collection(Comment::all())->resolve();

        return inertia('Admin/Comment/Index', compact('comments'));
    }
    public function show(Comment $comment)
    {
        $comment = CommentResource::make($comment)->resolve();

        return inertia('Admin/Comment/Show', compact('comment'));
    }
    public function create()
    {
        return inertia('Admin/Comment/Create');
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['post_id'] = Post::first()->id;
        $data['profile_id'] = Profile::first()->id;
        $comment = CommentService::store($data);
        return CommentResource::make($comment)->resolve();
//        return response()->json(['message' => 'post created']);
//        return inertia('Admin/Post/Create');
    }
}
