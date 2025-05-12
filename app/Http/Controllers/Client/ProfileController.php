<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = ProfileResource::collection(Profile::all()->
        where('id', '!=', auth()->user()->profile->id))->
        resolve();

        return inertia('Client/Profile/Index', compact('profiles'));
    }

    public function show(Profile $profile)
    {
        $profile = ProfileResource::make($profile)->resolve();
        $authProfile = auth()->user()->profile;
        return inertia('Client/Profile/Show', compact('profile', 'authProfile'));
    }
}
