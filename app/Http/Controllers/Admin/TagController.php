<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use App\Services\TagService;

class TagController extends Controller
{
    public function index()
    {
        $tags = TagResource::collection(Tag::all())->resolve();
        return inertia('Admin/Tag/Index', compact('tags'));
    }
    public function show($id) // Изменяем инъекцию модели
    {
        $tag = Tag::findOrFail($id); // Явно находим модель
        return inertia('Admin/Tag/Show', [
            'tagData' => TagResource::make($tag)->resolve() // Переименовываем ключ
        ]);
    }
    public function create()
    {
        return inertia('Admin/Tag/Create');
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $tag = TagService::store($data);
        return TagResource::make($tag)->resolve();
//        return response()->json(['message' => 'post created']);
//        return inertia('Admin/Post/Create');
    }
    public function destroy(Tag $tag)
    {
        $tag = TagService::destroy($tag);
        return back()->with([
            'success' => 'Тег удален',
            'removedId' => $tag->id // Можно передать ID для клиента
        ]);
    }
}
