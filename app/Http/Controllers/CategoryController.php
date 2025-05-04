<?php

namespace App\Http\Controllers;

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

    public function store($title)
    {
        $data = [
            'title' => $title,
        ];
        return CategoryResource::make(CategoryService::store($data))->resolve();


    }

    public function update(Category $category)
    {
        $data = [
            'title' => 'new updated category',
        ];


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
