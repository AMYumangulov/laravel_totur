<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StoreRequest;
use App\Http\Requests\Api\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all())->resolve() ;
    }

    public function show(User $user)
    {
        return UserResource::make( $user)->resolve();
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        return UserResource::make(UserService::store($data))->resolve();


    }

    public function update(UpdateRequest $request,User $user)
    {
        $data = $request->validated();
        return UserResource::make(UserService::update($user,$data ))->resolve();
    }

    public function destroy(User $user)
    {
        $user= UserService::destroy($user);
        return response(
            ['message' => $user['id'] . 'user deleted'],
            Response::HTTP_OK
        );
    }
}
