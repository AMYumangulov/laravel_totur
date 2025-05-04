<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Like\StoreRequest;
use App\Http\Requests\Api\Like\UpdateRequest;
use App\Http\Resources\Like\LikeResource;
use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Services\LikeService;
use Illuminate\Http\Response;

class LikeController extends Controller
{
    public function index()
    {
        return LikeResource::collection(Like::all())->resolve() ;
    }

    public function show(Like $like)
    {
        return LikeResource::make( $like)->resolve();
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        return LikeResource::make(LikeService::store($data))->resolve();


    }

    public function update(UpdateRequest $request,Like $like)
    {
        $data = $request->validated();
        return LikeResource::make(LikeService::update($like, $data))->resolve();
    }

    public function destroy(Like $like)
    {

        LikeService::destroy($like);
        return response(
            ['message' => 'deleted'],
            Response::HTTP_OK
        );
    }
}
