<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (!Gate::allows('index chat')) abort(404);

        $chats = Chat::query()->get()
            ->map(function($chat)  {
                $chat->last_message_time = false;
                if($chat->messages->last()) {
                    $chat->last_message_time = $chat->messages->last()->created_at;
                }

                return $chat;
            })
            ->sortByDesc('last_message_time');

        return view('chat.index', compact('chats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
