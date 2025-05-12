<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Chat\IndexRequest;
use App\Http\Requests\Client\Chat\StoreMessageRequest;
use App\Http\Requests\Client\Chat\StoreRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Message\MessageResource;
use App\Models\Chat;
use App\Services\ChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $chat = ChatService::store($data);

        return to_route('chats.show', $chat->id);
    }

    public function storeMessage(StoreMessageRequest $request, Chat $chat)
    {
        $data = $request->validationData();

        return MessageResource::make($chat->messages()->create($data))->resolve();
    }

    public function show(Chat $chat)
    {
        $chat = ChatResource::make($chat)->resolve();

        return inertia('Client/Chat/Show', compact('chat'));
    }

    public function indexMessage(IndexRequest $request, Chat $chat)
    {
        $data = $request->validationData();

        $messages = $chat->messages()->latest()->paginate($data['per_page'],
            '*',
            'page',
            $data['page']);

        $messages = MessageResource::collection($messages);

        return $messages;
    }


}
