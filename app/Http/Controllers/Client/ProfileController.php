<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Profile $profile)
    {
        $profile = ProfileResource::make($profile)->resolve();
        return inertia('Client/Profile/Show', compact('profile'));
    }
}
