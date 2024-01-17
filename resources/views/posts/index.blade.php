<x-app-layout>
    <x-slot name="CamCon">
        @if (Route::is('mypage'))
            mypage
        @else
            index
        @endif
    </x-slot>

    <style>
        body {
            margin: 0; 
            font-family: 'Helvetica Neue', sans-serif; 
        }

        .like-button-container {
            display: flex;
            align-items: center;
        }

        .like-button {
            color: white;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            outline: none;
        }

        .like-button.active {
            color: #1877f2;
        }

        .post {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
            height: auto;
        }

        .user-time-info,
        .category,
        .title,
        .body {
            margin-bottom: 10px;
        }

        .container {
            max-width: 600px; 
            margin: 30px auto 0 auto;
        }

        .post-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .post-actions-left {
            display: flex;
            align-items: center;
        }

        .post-actions-left a {
            display: inline-block;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 8px;
        }
        
        .main {
            display: flex;
            justify-content: space-between;
        }

        .nav-menu {
            width: 150px;
            padding: 10px;
            background-color: #f0f0f0;
            border-right: none;
            height: 100vh;
            overflow-y: auto;
        }

        .timeline {
            /*border-right: 1px solid #ccc;*/
            overflow-y: auto;
            max-height: 100vh;  
        }

        .timeline-heading {
            text-align: center;
            border-bottom: 3px solid #ccc;
            font-size: 2em;
            margin: 0;
            padding: 10px;
        }
    </style>

    @php
        $categoryIds = [
            'university' => 1,
            'daily_issues' => 2,
            'job_advice' => 3,
        ];
    @endphp

    <div class ="main" style="display:flex; justify-content: center;">
        <div class="nav-menu" style= "margin-right: 100px;">
            <p><a href="{{ route('mypage') }}" style="font-size: 1.5em; margin-bottom: 10px;">マイページ</a></p>
            <p><a href="{{ route('create') }}" style="font-size: 1.2em; margin-bottom: 10px;">質問・相談投稿</a></p>
            <p><a href="{{ route('showCategoryPosts', $categoryIds['university']) }}" style="font-size: 1.2em; background-color: limegreen; color: white; margin-bottom: 10px;">大学の課題</a></p>
            <p><a href="{{ route('showCategoryPosts', $categoryIds['daily_issues']) }}" style="font-size: 1.2em; background-color: crimson; color: white; margin-bottom: 10px;">日ごろの悩み</a></p>
            <p><a href="{{ route('showCategoryPosts', $categoryIds['job_advice']) }}" style="font-size: 1.2em; background-color: deepskyblue; color: white; margin-bottom: 10px;">就活のアドバイス</a></p>
        </div>
    
        <div class="timeline">
            <h1 class="timeline-heading">CampusConnect</h1>
    
            <div class="container">
                @foreach ($posts->reverse() as $post)
                    <a href="{{ route('show', $post->id) }}" style="text-decoration: none; color: inherit;">
                        <div class='post'>
                            @if (Auth::check())
                                <p class='user-time-info'>
                                    {{ Auth::user()->name }},
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                            @endif
                            <p class='category'>カテゴリー: {{ $post->category->name }}</p>
                            <h2 class='title'>{{ $post->title }}</h2>
                            <p class='body'>{{ $post->body }}</p>
    
                            <div class="post-actions">
                                <div class="post-actions-left">
                                    <button type="button" onclick="toggleLike({{ $post->id }})" class="like-button @if($post->liked) active @endif" data-post-id="{{ $post->id }}">
                                        &#x1F44D;
                                    </button>
                                    <span class="like-text @if($post->liked) active @endif">いいね</span>
                                </div>
                                <button type="button" onclick="toggleComments({{ $post->id }})">コメント</button>
                                <button type="button" onclick="savePost({{ $post->id }})">保存</button>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function toggleLike(postId) {
            const likeButton = document.querySelector(`.like-button[data-post-id="${postId}"]`);
            const likeText = document.querySelector(`.like-text[data-post-id="${postId}"]`);
            likeButton.classList.toggle('active');
            likeText.classList.toggle('active');
        }
    </script>
    
    <script>
        const timeline = document.querySelector('.timeline');
        
        function scrollBottom() {
            timeline.scrollTop = timeline.scrollHeight;
        }
        window.onload = scrollBottom;
        function addNewPost() {
            scrollToBottom();
        }
    </script>
</x-app-layout>
