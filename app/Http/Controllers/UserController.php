<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
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
    
    public  function editUserDetails()
    {
        $user = auth()->user();
        $userPosts = $user->posts;
        
        return view('mypage.editUserDetails', compact('user', 'userPosts'));
    }
}
