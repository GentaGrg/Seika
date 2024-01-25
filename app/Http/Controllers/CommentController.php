<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Log; // Log クラスをインポート

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required',
        ]);

        try {
            // コメントを作成
            $comment = Comment::create([
                'post_id' => $request->post_id,
                'user_id' => auth()->id(),
                'body' => $request->body,
            ]);

            // 対応する投稿の数更新
            Post::find($request->post_id)->increment('comments_count');

            // ログに出力してデバッグ
            Log::info('Comment stored successfully: ' . $comment);

            return back()->with('success', 'コメントが投稿されました。');
        } catch (\Exception $e) {
            // エラーが発生した場合の処理
            Log::error('Error storing comment: ' . $e->getMessage());

            return back()->with('error', 'コメントの投稿中にエラーが発生しました。');
        }
    }
}
