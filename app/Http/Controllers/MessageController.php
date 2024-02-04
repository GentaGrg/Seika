<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function create(Request $request, $userId)
    {
        // メッセージを作成する処理
        $message = new Message();
        $message->sender_id = auth()->user()->id;
        $message->receiver_id = $userId;
        $message->content = $request->input('content');
        $message->save();

        return response()->json(['success' => true, 'message' => 'メッセージが送信されました。']);
    }
}
