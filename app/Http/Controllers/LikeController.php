<?php

namespace App\Http\Controllers;

use App\Http\Resources\Like\LikeResource;
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

    public function store()
    {
        $data = [
            'count' => 1,
            'type' => 'new type',
            'author'=> 'new author'
        ];

        return LikeResource::make(LikeService::store($data))->resolve();


    }

    public function update(Like $like)
    {
        $data = [
            'count' => 6,
        ];

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
