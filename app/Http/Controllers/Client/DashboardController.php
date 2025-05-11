<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostVueResource;
use App\Models\Post;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = PostVueResource::collection(Post::latest()->get())->resolve();

        if (Request::wantsJson()) {
            return $posts;
        }

        return inertia('Client/Dashboard/Index', compact('posts'));
    }
    public function test()
{
    return inertia('Client/Dashboard/test');
}
}
