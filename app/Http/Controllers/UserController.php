<?php

namespace App\Http\Controllers;

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

    public function store()
    {
        $userCount = User::query()->count();
        $data = [
            'name' => 'new user',
            'email' => $userCount . '@mail.ru',
            'password' => '123456'
        ];
        return UserResource::make(UserService::store($data))->resolve();


    }

    public function update(User $user)
    {
        $data = [
            'name' => 'new updated User',
        ];

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
