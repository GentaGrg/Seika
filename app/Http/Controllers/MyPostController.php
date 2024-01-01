<?php

// app/Http/Controllers/MyPostsController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MyPostsController extends Controller
{
    public function index()
    {
        // ログインユーザーの投稿一覧を取得
        $userPosts = Auth::user()->posts;

        // ビューを返す
        return view('myposts.index', compact('userPosts'));
    }
}
