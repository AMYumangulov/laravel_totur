<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryResource::collection(Category::all())->resolve();

        return inertia('Admin/Category/Index', compact('categories'));
    }
    public function show(Category $category)
    {
        $category = CategoryResource::make($category)->resolve();

        return inertia('Admin/Category/Show', compact('category'));
    }
    public function create()
    {
        return inertia('Admin/Category/Create');
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $category = CategoryService::store($data);
        return CategoryResource::make($category)->resolve();
//        return response()->json(['message' => 'post created']);
//        return inertia('Admin/Post/Create');
    }
}
