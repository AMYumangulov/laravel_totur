<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\StoreRequest;
use App\Http\Requests\Api\Category\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all())->resolve() ;
    }

    public function show(Category $category)
    {
        return CategoryResource::make( $category)->resolve();
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        return CategoryResource::make(CategoryService::store($data))->resolve();


    }

    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        return CategoryResource::make(CategoryService::update($category,$data))->resolve();
    }

    public function destroy(Category $category)
    {
        $category = CategoryService::destroy($category);
        return response(
            ['message' => $category['id'] . ' id deleted'],
            Response::HTTP_OK
        );
    }
}
