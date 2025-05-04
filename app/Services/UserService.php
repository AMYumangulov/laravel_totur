<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Create a new class instance.
     */
    public static function store(array $data): User
    {
        return  User::create($data);
    }

    public static function update($user, array $data): User
    {
        $user->update($data);
        return  $user;
    }

    public static function destroy($user ): User
    {
        $user->delete();
        return  $user;
    }
}
