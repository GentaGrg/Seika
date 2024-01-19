<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required',
        ]);

        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        // 対応する投稿の数更新
        Post::find($request->post_id)->increment('comments_count');

        return back()->with('success', 'コメントが投稿されました。');
    }
}
