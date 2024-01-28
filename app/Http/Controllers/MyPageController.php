<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post; // Import the Post model

class MyPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $all_users = User::where('id', '!=', $user->id)->paginate(10); // 10は1ページに表示するユーザー数を示しています
        $latestPost = Post::latest()->first(); // Get the latest post

        return view('mypage.index', compact('user', 'all_users', 'latestPost'));
    }
}
