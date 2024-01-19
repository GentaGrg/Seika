<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
   public function toggleFollow(User $userToFollow)
{
    // フォローのトグル処理
    auth()->user()->toggleFollow($userToFollow);

    // ユーザーネームの更新などが必要な場合はここで行う

    return back(); // 適切なリダイレクトに変更
}
}
