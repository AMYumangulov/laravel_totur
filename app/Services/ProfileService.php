<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Profile;

class ProfileService
{
    /**
     * Create a new class instance.
     */
    public static function store(array $data): Profile
    {
        return  Profile::create($data);
    }

    public static function update($profile, array $data): Profile
    {
        $profile->update($data);
        return  $profile;
    }

    public static function destroy($profile ): Profile
    {
        $profile->delete();
        return  $profile;
    }
}
