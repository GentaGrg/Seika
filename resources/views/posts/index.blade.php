<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    
    </head>
    <body>
    @extends('layouts.app')

@section('content')
    <h2>Posts</h2>

    <a href="{{ route('posts.create') }}">Create a New Post</a>

    @foreach ($posts as $post)
        <div>
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->content }}</p>
        </div>
    @endforeach
@endsection
    </body>
</html>