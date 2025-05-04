<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Role;

class RoleService
{
    /**
     * Create a new class instance.
     */
    public static function store(array $data): Role
    {
        return  Role::create($data);
    }

    public static function update($role, array $data): Role
    {
        $role->update($data);
        return  $role;
    }

    public static function destroy($role ): Role
    {
        $role->delete();
        return  $role;
    }
}
