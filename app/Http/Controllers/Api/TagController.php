<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tag\StoreRequest;
use App\Http\Requests\Api\Tag\UpdateRequest;
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

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        return TagResource::make(TagService::store($data))->resolve();


    }

    public function update(UpdateRequest $request,Tag $tag)
    {
        $data = $request->validated();
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
