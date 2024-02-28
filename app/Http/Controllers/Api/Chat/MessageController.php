<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request) {

        $chat = Chat::query()->where('id', $request->chat_id)->firstOrFail();

        $message = new Message();
        $message->chat_id = $chat->id;
        $message->message = $request->message;
        $message->account_id = auth()->user()->id;
        $message->save();

        if($chat->account_id == auth()->user()->id) {
            $companionId = $chat->companion_id;
        }
        else {
            $companionId = $chat->account_id;
        }


        event(new \App\Events\SendMessage($companionId, $message));

    }
}
