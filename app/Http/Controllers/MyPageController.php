<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('mypage.index', compact('user'));
    }
}
