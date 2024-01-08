<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Suport\Facades\Auth;

class PostController extends Controller
{
    // app/Http/Controllers/PostController.php

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    
    public function create(Category $category)
    {
        $categories = Category::all(); 
    
        return view('posts.create', compact('categories'));
    }
    
    public function show(Post $post)
    {
        return view('posts.show')->with('post', $post);
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function store(Request $request, Post $post)
    {
     $input= $request['post'];
     
     $post->fill($input)->save();
     return redirect()->route('myposts');
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function mypage(Post $post)
    {
        return view('mypage.index')->with('user', Auth::user());
    }
    public function myPosts(Post $post)
    {
        
        $userPosts = $post->get();
    
        return view('myposts.index', compact('userPosts'));
    }
    
    public function showCategoryPosts($categoryId) {
        $categoryPosts = Post::where('category_id', $categoryId)->get();
        return view('category_posts.index', ['categoryPosts' => $categoryPosts]);
    }
}