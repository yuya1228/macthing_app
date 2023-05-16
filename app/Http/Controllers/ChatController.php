<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    public function chat()
    {
        return view('chat');
    }

    public function store(Request $request)
    {
        $senderId = $request->input('sender_id');
        $receiverId = $request->input('receiver_id');
        $message = $request->input('message');

        $chat = new Chat();
        $chat ->sender_id = $senderId;
        $chat ->receiver_id = $receiverId;
        $chat ->message = $message;
        $chat ->save();

        return redirect()->json(['chat_message'=>'チャットメッセージを送信しました。']);
    }
}
