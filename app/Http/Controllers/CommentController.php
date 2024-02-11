<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function markAsBestAnswer(Comment $comment)
    {
        // コメントをベストアンサーとしてマークするロジックを追加
        $comment->markAsBestAnswer();
    
        return response()->json(['success' => true]);
    }
    
    public function store(Request $request)
    {
        // バリデータを作成
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'body' => 'required',
        ]);

        // バリデーションが失敗した場合は、エラーメッセージをログに記録
        if ($validator->fails()) {
            Log::error('Validation failed: ' . implode(', ', $validator->errors()->all()));
            return back()->with('error', 'コメントのバリデーションに失敗しました。');
        }

        // ログにコメントの内容を追加
        Log::info('Received comment request: ' . json_encode($request->all()));

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

            // デバッグ用：コメントの内容をログに出力
            Log::info('Comment content: ' . $request->body);

            return back()->with('success', 'コメントが投稿されました。');
        } catch (\Exception $e) {
            // エラーが発生した場合の処理
            Log::error('Error storing comment: ' . $e->getMessage());
            return back()->with('error', 'コメントの投稿中にエラーが発生しました。');
        }
    }
}

