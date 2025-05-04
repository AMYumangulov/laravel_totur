<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Response;

class TagController extends Controller
{
    public function index()
    {
        return TagResource::collection(Tag::all())->resolve() ;
    }

    public function show(Tag $tag)
    {
        return TagResource::make( $tag)->resolve();
    }

    public function store()
    {
        $data = [
            'title' => 'new tag',
        ];
        return TagResource::make(TagService::store($data))->resolve();


    }

    public function update(Tag $tag)
    {
        $data = [
            'title' => 'new updated tag',
        ];

        return TagResource::make(TagService::update($tag, $data))->resolve();
    }

    public function destroy(TAg $tag)
    {
        $tag = TagService::destroy($tag);
        return response(
            ['message' => $tag['id'] . ' deleted'],
            Response::HTTP_OK
        );
    }
}
