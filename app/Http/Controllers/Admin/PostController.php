<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\IndexRequest;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostVueResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use App\Services\PostService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validationData();
        $key = 'posts_' . md5(json_encode($data));
        $posts = Cache::remember($key, now()->addMinutes(10), function () use ($data) {
            return PostVueResource::collection(
                Post::
                filter($data)->
                latest()->
                paginate($data['per_page'],
                    '*',
                    'page',
                    $data['page'])
            );
        });

        $profiles = ProfileResource::collection(Profile::all())->resolve();
        $categories = CategoryResource::collection(Category::all())->resolve();
        if (Request::wantsJson()) {
            return $posts;
        }
        return inertia('Admin/Post/Index', compact('posts', 'profiles', 'categories'));
    }

    public function show(Post $post)
    {
        $post = PostResource::make($post)->resolve();
        return inertia('Admin/Post/Show', compact('post'));
    }

    public function create()
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        return inertia('Admin/Post/Create', compact('categories'));
    }

    public function edit(Post $post)
    {
        $titles  = $post->getTagsAsString();
        $post = PostResource::make($post)->resolve();
        $categories = CategoryResource::collection(Category::all())->resolve();

        return inertia('Admin/Post/Update', compact('post', 'titles', 'categories'));
    }


    public function store(StoreRequest $request)
    {
        $data = $request->except('image', 'tags');
        $post = PostService::store($data);
        return PostResource::make($post)->resolve();
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->except('image', 'tags');

        $post = PostService::update($post, $data);
        return PostResource::make($post)->resolve();
//        return response()->json(['message' => 'post created']);
//        return inertia('Admin/Post/Create');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'message' => 'deleted'
        ]);
    }
}
