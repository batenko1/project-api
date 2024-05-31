<?php

namespace App\Http\Controllers\Api\Chat;

use App\Events\SendMessage;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {

        $chat = Chat::query()->where('id', $request->chat_id)->first();


        if ($request->uuid) {
            $user = User::query()->first();
        } else {
            $user = User::query()->where('id', $request->user_id)->first();
        }


        $html = '';
        $marker = false;

        if (!$chat) {
            $chat = new Chat();
            $chat->uuid = $request->uuid;
            $chat->companion_id = $user->id;
            $chat->save();


            $marker = true;
        }

        $message = new Message();
        $message->chat_id = $chat->id;
        $message->message = $request->message;


        if ($request->uuid) {
            $message->uuid = $request->uuid;
            $companionId = $user->id;

        } else {
            $message->account_id = $user->id;
            $message->is_read = 1;
            $companionId = $request->uuid ?? $chat->uuid;
        }


        $message->save();

        $chat->load('messages');

        $messageHtml = '';

        $html = view('chat.blocks.chat-render', compact('chat'))->render();

        if ($request->uuid) {
            $messageHtml = view('chat.blocks.message-render', compact('message'))->render();
        }


        event(new SendMessage($companionId, $message, $html, $messageHtml));

        if ($request->user_id) {
            return view('chat.blocks.message-render', compact('message'))->render();
        }


    }
}
