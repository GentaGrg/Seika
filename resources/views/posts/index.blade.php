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
     
    @php
    $categoryIds = [
        'university' => 1,
        'daily_issues' => 2,
        'job_advice' => 3,
    ];
    @endphp
　　
   <div style="width: 12cm; height: 15cm; float: left; margin-top: 130px; margin-left: 200px; border: 2px solid #ccc; padding: 10px; overflow-y: auto;">
    @foreach ($posts->reverse() as $post)
        <div class='post'>
            <a href="{{ route('show', $post->category->id) }}" style="font-weight: bold; font-size: 1.1em;">
                {{ $post->category->name }}</a>
            <h2 class='title'><a href="{{ route('show', $post->id) }}">{{ $post->title }}</a></h2>
            <p class='body'>{{ $post->body }}</p>
            
            <!-- ログインユーザーと投稿時間を表示 -->
            @if (Auth::check()) <!-- ユーザーがログインしているかどうかを確認 -->
                <p class='user-time-info'>
                    投稿者: {{ Auth::user()->name }}, 
                    投稿時間: {{ $post->created_at->diffForHumans() }} <!-- 投稿時間を"何時間前"として表示 -->
                </p>
            @endif

            <form action="{{ route('index')}}" id="form_{{ $post->id }}" method="post">
                <button type="button" onclick="likePost({{ $post->id }})">いいね</button>
                <button type="button" onclick="showComments({{ $post->id }})">コメント</button>
                <button type="button" onclick="savePost({{ $post->id }})">保存</button>
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
            </form>
        </div>
    @endforeach
</div>



    <div style="border: 2px solid #ccc; padding: 10px; margin-bottom: 10px; float; left;">
        <a href="{{ route('create') }}" style="display: inline-block; padding: 8px; border: 1px solid #ccc; border-radius: 5px; text-decoration: none; margin-bottom: 8px;">質問・相談投稿</a>
        <a href="{{ route('showCategoryPosts', $categoryIds['university']) }}" style="display: inline-block; padding: 8px; border: 1px solid #ccc; border-radius: 5px; text-decoration: none; margin-bottom: 8px; background-color: limegreen; color: white;">大学の課題</a>
        <a href="{{ route('showCategoryPosts', $categoryIds['daily_issues']) }}" style="display: inline-block; padding: 8px; border: 1px solid #ccc; border-radius: 5px; text-decoration: none; margin-bottom: 8px; background-color: crimson; color: white;">日ごろの悩み</a>
        <a href="{{ route('showCategoryPosts', $categoryIds['job_advice']) }}" style="display: inline-block; padding: 8px; border: 1px solid #ccc; border-radius: 5px; text-decoration: none; margin-bottom: 8px; background-color: deepskyblue; color: white;">就活のアドバイス</a>
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
