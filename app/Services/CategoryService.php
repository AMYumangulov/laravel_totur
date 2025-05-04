<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    public static function store(array $data): Category
    {
        return  Category::create($data);
    }

    public static function update($category, array $data): Category
    {
        $category->update($data);
        return  $category;
    }

    public static function destroy($category): Category
    {
        $category->delete();
        return  $category;
    }
}
