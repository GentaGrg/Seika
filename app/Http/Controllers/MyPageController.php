<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\AnswerLater; // Import the AnswerLater model

class MyPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $all_users = User::where('id', '!=', $user->id)->paginate(10);
        $latestPost = Post::latest()->first();

        // ログインユーザーの後で解答に保存した投稿を取得
        $answerLaterPosts = $user->answerLaterPosts()->paginate(10);

        return view('mypage.index', compact('user', 'all_users', 'latestPost', 'answerLaterPosts'));
    }

    public function addToAnswerLater($postId)
    {
        $user = auth()->user();

        // ログインユーザーがすでに後で解答に保存しているか確認
        $alreadySaved = $user->answerLaterPosts()->where('post_id', $postId)->exists();

        if (!$alreadySaved) {
            // 後で解答に保存
            AnswerLater::create([
                'user_id' => $user->id,
                'post_id' => $postId,
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => '既に保存されています。']);
    }
}
