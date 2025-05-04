<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Role\StoreRequest;
use App\Http\Requests\Api\Role\UpdateRequest;
use App\Http\Resources\Role\RoleResource;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    public function index()
    {
        return RoleResource::collection(Role::all())->resolve() ;
    }

    public function show(Role $role)
    {
        return RoleResource::make( $role)->resolve();
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        return RoleResource::make(RoleService::store($data))->resolve();


    }

    public function update(UpdateRequest $request,Role $role)
    {
        $data = $request->validated();
        return RoleResource::make(RoleService::update($role,$data))->resolve();

    }

    public function destroy(Role $role)
    {

        $role = RoleService::destroy($role);
        return response(
            ['message' => $role['id'] . 'deleted'],
            Response::HTTP_OK
        );
    }
}
