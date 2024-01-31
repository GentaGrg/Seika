<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('posts.index', compact('posts'));
    }
    
    public function update(Request $request)
    {
        // フォームからのデータを取得
        $userData = $request->only(['name', 'nickname', 'birthdate', 'university', 'grade', 'faculty']);

        // ログイン中のユーザーの情報を取得
        $user = Auth::user();

        // 取得したデータをユーザーモデルに反映
        $user->update($userData);

        // 更新後にプロフィールページにリダイレクト
        return redirect()->route('profile')->with('success', 'ユーザー情報が更新されました。');
    }
    
    public function editUserDetails()
    {
        $user = auth()->user();
        return view('mypage.editUserDetails', compact('user'));
    }
    
    public function follow(User $user)
    {
        $follower = Auth::user();

        // フォローしているか
        $is_following = $follower->isFollowing($user->id);

        if (!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back()->with('success', 'ユーザーをフォローしました。');
        }

        return back()->with('info', '既にフォローしています。');
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = Auth::user();

        // フォローしているか
        $is_following = $follower->isFollowing($user->id);

        if ($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back()->with('success', 'ユーザーのフォローを解除しました。');
        }

        return back()->with('info', 'フォローしていないユーザーです。');
    }
}
