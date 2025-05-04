<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::all())->resolve() ;
    }

    public function show(Post $post)
    {
        return PostResource::make( $post)->resolve();
    }

    public function store()
    {
        $data = [
            'title' => 'new post',
        ];
        return PostResource::make(PostService::store($data))->resolve();


    }

    public function update(Post $post, $title)
    {
        $data = [
            'title' => $title,
        ];

        return PostResource::make(PostService::update($post, $data))->resolve();
    }

    public function destroy(Post $post)
    {
        $post = PostService::destroy($post);
        return response(
            ['message' => $post['id'].' id deleted'],
            Response::HTTP_OK
        );
    }
}
