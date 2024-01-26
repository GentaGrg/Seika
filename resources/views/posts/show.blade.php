<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('index') }}" class="back-link">&#8592;</a>
    </x-slot>
    <style>
        .twitter-style-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff; /* Twitterのデフォルトの背景色 */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .twitter-style-header {
            padding-bottom: 10px;
            border-bottom: 1px solid #eee; /* Twitterのデフォルトのボーダー色 */
        }

        .twitter-style-body {
            padding: 10px 0;
        }

        .twitter-style-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 1px solid #eee; /* Twitterのデフォルトのボーダー色 */
        }

        .twitter-style-footer a {
            text-decoration: none;
            color: #1DA1F2; /* Twitterのデフォルトのリンク色 */
        }

        .twitter-style-footer a:hover {
            text-decoration: underline;
        }

        .back-link {
            margin-right: 20px;
            text-decoration: none;
            color: black; /* 矢印の色を黒に変更 */
            font-size: 30px; /* 矢印のサイズを大きくする */
            font-weight: bold; /* 矢印を太くする */
        }

        .photo-area {
            margin-top: 20px;
            overflow: hidden;
        }

        .photo-area img {
            width: 100%;
            height: auto;
            border-radius: 10px; /* 任意の角丸を追加 */
        }
    </style>
    <div class="twitter-style-container">
        @if (Auth::check())
        <p class='user-time-info'>
            @if ($post->user)
                {{ $post->user->name }},
            @else
                Anonymous,
            @endif
            {{ $post->created_at->diffForHumans() }}
            @if ($post->user && $post->user->id !== auth()->user()->id)
                <button type="button" onclick="toggleFollow(event, {{ $post->user->id }})" class="follow-button @if(auth()->user()->isFollowed($post->user->id)) active @endif" data-user-id="{{ $post->user->id }}">
                    @if(auth()->user()->isFollowed($post->user->id))
                        フォロー中
                    @else
                        フォローする
                    @endif
                </button>
            @endif
        </p>
    @endif
        <div class="twitter-style-header">
            <h1 class="title">
                {{ $post->title }}
            </h1>
        </div>
        <div class="twitter-style-body">
            <div class="content">
                <div class="content_post">
                    <h3>本文</h3>
                    <p class='body'>{{ $post->body }}</p>
                </div>
            </div>
        </div>
        <div class="photo-area">
            <img src="https://placekitten.com/600/400" alt="Photo">
        </div>
        <div class="twitter-style-footer">
            <div class="edit">
                <a href="/posts/{{ $post->id }}/edit">edit</a>
            </div>
            <div>
                <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
            </div>
        </div>
    </div>
</x-app-layout>
