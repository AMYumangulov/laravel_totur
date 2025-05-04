<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\StoreRequest;
use App\Http\Requests\Api\Profile\UpdateRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Profile;
use App\Services\ProfileService;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function index()
    {
        return ProfileResource::collection(Profile::all())->resolve() ;
    }

    public function show(Profile $profile)
    {
        return ProfileResource::make( $profile)->resolve();
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        return ProfileResource::make(ProfileService::store($data))->resolve();
    }

    public function update(UpdateRequest $request,Profile $profile)
    {
        $data = $request->validated();
        return ProfileResource::make(ProfileService::update($profile, $data))->resolve();
    }

    public function destroy(Profile $profile)
    {
        ProfileService::destroy($profile);
        return response(
            ['message' => 'deleted'],
            Response::HTTP_OK
        );
    }
}
