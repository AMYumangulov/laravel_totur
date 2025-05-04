<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\StoreRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use App\Services\PostService;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = ProfileResource::collection(Profile::all())->resolve();

        return inertia('Admin/Profile/Index', compact('profiles'));
    }
    public function show(Profile $profile)
    {
        $profile = ProfileResource::make($profile)->resolve();

        return inertia('Admin/Profile/Show', compact('profile'));
    }
    public function create()
    {
        return inertia('Admin/Profile/Create');
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $profile = ProfileService::store($data);
        return ProfileResource::make($profile)->resolve();
//        return response()->json(['message' => 'post created']);
//        return inertia('Admin/Post/Create');
    }
}
