<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    // app/Http/Controllers/PostController.php

public function create()
{
    $categories = Category::all(); 

    return view('posts.create', compact('categories'));
}

public function show(Post $post)
{
    return view('posts.show')->with('post', $post);
}

public function delete(Post $post)
{
    $post->delete();
    return redirect('/');
}

public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }

public function update(PostRequest $request, Post $post)
{
    $input_post = $request['post'];
    $post->fill($input)->save();
    return redirect('/posts/' . $post->id);
}

public function index(Post $post)
    {
        return view('posts.index')->with([
        'posts' => $post->getPaginateByLimit(),
    ]);
}
}