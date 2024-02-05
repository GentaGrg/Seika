<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('posts.index', compact('posts'));
    }

    public function create(Category $category)
    {
        $user = Auth::user();
        $categories = Category::all();

        return view('posts.create', compact('user', 'categories'));
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

    public function store(PostRequest $request, Post $post)
    {
        try {
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Please log in to create a post.');
            }

            $validatedData = $request->validated();

            $input = $request->input('post');
            $input['user_id'] = auth()->user()->id;

            $displayUserName = $request->input('post.display_user_name', true);

            $input['display_user_name'] = $displayUserName;
            $post->fill($input)->save();

            if ($request->hasFile('file_attachment')) {
                $post->saveImage($request->file('file_attachment'));
            }

            auth()->user()->decreasePoints(1);

            return redirect()->route('posts.index');

        } catch (\Exception $e) {
            \Log::error('Error storing post: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while storing the post.');
        }
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
    
    public function likePost($postId)
    {
        auth()->user()->likes()->toggle($postId);
        return redirect()->back();
    }
    
    public function commentPost(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $postId,
            'content' => $request->input('content'),
        ]);
    
        return redirect()->back();
    }
    
    public function saveForLater(Post $post)
    {
        // ユーザーモデルと認証されたユーザーが存在することを前提としています
        auth()->user()->addToMyPageAnswer($post);
    
        // 必要であればここで追加のロジックを追加できます
    
        return response()->json(['success' => true]);
    }
    
     protected function saveImage($file)
    {
        $path = $file->store('post_images', 'public');
        $this->image = $path;
        $this->save();
    }

    // Get image URL attribute
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}