<?php

namespace App\Services;

use App\Models\Chat;
use Illuminate\Support\Facades\DB;

class ChatService
{
    /**
     * Create a new class instance.
     */
    public static function store(array $data): Chat
    {
        $profileIds = [auth()->user()->profile->id, $data['profile_id']];

        $chat = Chat::whereHas('profiles', function ($query) use ($profileIds) {
            $query->whereIn('profile_id', $profileIds);
        }, '=', count($profileIds))->first();

        if (isset($chat)) {
            return $chat;
        }

        $chat = Chat::create();

        $chat->profiles()->syncWithoutDetaching([auth()->user()->profile->id, $data['profile_id']]);

        return $chat;

    }
}
