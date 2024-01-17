<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MyPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $all_users = User::where('id', '!=', $user->id)->paginate(10); // 10は1ページに表示するユーザー数を示しています
    
        return view('mypage.index', compact('user', 'all_users'));
    }
}
