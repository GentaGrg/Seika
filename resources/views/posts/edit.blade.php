<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Blog</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>
<body class="antialiased">
    <x-app-layout>
        <x-slot name="header">
            <h1>Blog Name</h1>
        </x-slot>

        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- 画像の表示 -->
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image">
            @endif

            <!-- 画像の削除 -->
            <div>
                <label for="remove_image">Remove Image:</label>
                <input type="checkbox" name="remove_image" id="remove_image">
            </div>

            <!-- 画像の変更 -->
            <div>
                <label for="new_image">Change Image:</label>
                <input type="file" name="new_image" id="new_image">
            </div>

            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ $post->title }}">
                <p class='title__error' style="color:red">{{ $errors->first('post.title') }} </p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も一日お疲れ様でした。">{{ $post->body }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <input type="submit" value="update">
        </form>

        <div class='footer'>
            <a href="{{ route('edit', $post) }}">戻る</a>
        </div>
    </x-app-layout>
</body>
</html>
