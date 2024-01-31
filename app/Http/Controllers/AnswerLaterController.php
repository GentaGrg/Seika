<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AnswerLaterController extends Controller
{
    public function show(Post $post)
    {
        return view('mypage.answer-later', ['post' => $post]);
    }
}