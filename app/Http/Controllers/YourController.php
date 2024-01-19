<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class YourController extends Controller
{
    public function index()
    {
        // 'user' リレーションシップを eager load
        $posts = Post::with('user')->get();

        return view('posts.index', compact('posts'));
    }
}