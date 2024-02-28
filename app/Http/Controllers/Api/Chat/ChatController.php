<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getChat(Request $request) {

        $chat = Chat::query()->where('id', $request->chat_id)->first();

        $chat->messages()->update(['is_read' => 1]);

        $html = view('chat.blocks.messages-render', compact('chat'));

        return $html;

    }
}
