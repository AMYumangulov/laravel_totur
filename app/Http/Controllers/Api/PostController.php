<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\PostException;
use App\Http\Resources\Post\PostResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\StoreRequest;
use App\Http\Requests\Api\Post\UpdateRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::filter($request->all())->get();
        //return PostResource::collection(Post::all())->resolve();
        return PostResource::collection($posts)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
//        $title = 'dsdseesvam';
//        $post = Post::firstOrCreate([
//            'title' =>$title
//        ],[
//            'profile_id' => 1,
//            'category_id' => 1,
//        ]);

        //PostException::ifPostExists($post);

        return PostResource::make($post)->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        return PostResource::make(PostService::store($data))->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    {

        $data = $request->validated();
        return PostResource::make(PostService::update($post, $data))->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post = PostService::destroy($post);
        return response(
            ['message' => $post['id'].' id deleted'],
            Response::HTTP_OK
        );
    }
}
