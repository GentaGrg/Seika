<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Suport\Facades\Auth;

class PostController extends Controller
{
    // app/Http/Controllers/PostController.php

    public function index()
    {
        $posts = Post::with('user')->get();
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
    
    public function store(PostRequest $request, Post $post)
    {
        try {
            // Check if the user is authenticated
            if (!auth()->check()) {
                // Handle the case where the user is not authenticated
                return redirect()->route('login')->with('error', 'Please log in to create a post.');
            }
    
            // Validate the request using the PostRequest
            $validatedData = $request->validated();
    
            // Add user_id to the input array
            $input = $request->input('post');
            $input['user_id'] = auth()->user()->id;
    
            // Check if the display_user_name checkbox is checked
            $displayUserName = $request->input('post.display_user_name', true);
    
            // Add display_user_name to the input array
            $input['display_user_name'] = $displayUserName;
    
            // Save the post
            $post->fill($input)->save();
    
            // Redirect to the previous page or any specific page after saving the post
            return redirect()->route('myposts'); // Change 'myposts' to the desired route name
    
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            \Log::error('Error storing post: ' . $e->getMessage());
    
            // Redirect back with an error message
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
}