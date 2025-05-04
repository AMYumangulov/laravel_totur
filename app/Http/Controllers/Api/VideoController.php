<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Video\StoreRequest;
use App\Http\Requests\Api\Video\UpdateRequest;
use App\Http\Resources\Video\VideoResource;
use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VideoResource::collection(Video::all())->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        return VideoResource::make(VideoService::store($data))->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return VideoResource::make($video)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Video $video)
    {
        $data = $request->validated();
        return VideoResource::make(VideoService::update($video, $data))->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video = VideoService::destroy($video);
        return response(
            ['message' => $video['id'].' id deleted'],
            Response::HTTP_OK
        );
    }
}
