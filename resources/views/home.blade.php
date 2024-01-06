<x-app-layout>
    <x-slot name="CamCon">
        @if (Route::is('mypage'))
            mypage
        @else
            index
        @endif
    </x-slot>

    <h1 style="border-bottom: 3px solid #ccc; font-size: 2em; margin: 0;">CampusConnect</h1>

    <a href="{{ route('mypage') }}">
        @if (Route::is('mypage'))
            <h1 style="border-bottom: 2px solid #ccc;">マイページ</h1>
        @else
            <h1 style="border-bottom: 2px solid #ccc;">マイページ</h1>
        @endif
    </a>

    <div style="width: 12cm; height: 15cm; float: left; margin-top: 80px; margin-left: 120px; border: 2px solid #ccc; padding: 10px;">
        @if (isset($posts) && count($posts) > 0)
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'><a href="{{ route('show', $post->id) }}">{{ $post->title }}</a></h2>
                    <a href="{{ route('show', $post->category->id) }}">{{ $post->category->name }}</a>
                    <p class='body'>{{ $post->body }}</p>
                    <form action="{{ route('delete', $post->id) }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
                    </form>
                </div>
            @endforeach
        @else
        @endif
    </div>
    <div style="border: 2px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <a href="{{ route('create') }}" style="display: inline-block; padding: 8px; border: 1px solid #ccc; border-radius: 5px; text-decoration: none;">質問・相談投稿</a>
    </div>
    <div style="width: 8.5cm; height: 9cm; float: right; margin-top: 10px; margin-right: 120px; border: 2px solid #ccc; padding: 10px;">
    <p>1位</p>
    <p>2位</p>
    <p>3位</p>
</div>

<div style="width: 8.5cm; height: 9cm; float: right; margin-top: 370px; margin-right: -320px; border: 2px solid #ccc; padding: 10px;">
    <p style="font-weight: bold;">人気ワードランキング</p>
    <ul>
        <li>キーワード1</li>
        <li>キーワード2</li>
        <li>キーワード3</li>
    </ul>
</div>
　　<script>
            function deletePost(id) {
                'use strict';
                
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
    </script>
</x-app-layout>
