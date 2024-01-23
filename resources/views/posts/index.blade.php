<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .like-button {
            background-color: white;
            border: 1px solid #1877f2;
            color: #1877f2;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        
        .like-button.active {
            background-color: #1877f2;
            color: white;
        }
        
        .like-button.clicked {
            background-color: #1877f2;
            color: white;
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
        
        .post-link {
            text-decoration: nome;
            color: inherit;
        }
        
        .post-link:hover {
            background-color: #f0f0f0;
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
            overflow-y: hidden;
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

    <div class="main" style="display:flex; justify-content: center; max-width: 1200px; margin: 0 auto;">
        <div class="nav-menu" style="margin-right: 100px; margin-bottom: 50px">
            <p><a href="{{ route('mypage') }}" style="font-size: 1.5em; margin-bottom: 10px;">マイページ</a></p>
            <p><a href="{{ route('create') }}" style="font-size: 1.2em; margin-bottom: 10px;">質問・相談投稿</a></p>
            <p><a href="{{ route('showCategoryPosts', $categoryIds['university']) }}" style="font-size: 1.2em; background-color: limegreen; color: white; margin-bottom: 10px;">大学の課題</a></p>
            <p><a href="{{ route('showCategoryPosts', $categoryIds['daily_issues']) }}" style="font-size: 1.2em; background-color: crimson; color: white; margin-bottom: 10px;">日ごろの悩み</a></p>
            <p><a href="{{ route('showCategoryPosts', $categoryIds['job_advice']) }}" style="font-size: 1.2em; background-color: deepskyblue; color: white; margin-bottom: 10px;">就活のアドバイス</a></p>
        </div>

        <div class="timeline" style="flex-grow: 1; max-width: 800px;">
        <h1 class="timeline-heading">CampusConnect</h1>

        <div class="container">
        @foreach ($posts->reverse() as $post)
            <div class='post'>
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
                <p class='category'>カテゴリー: {{ $post->category->name }}</p>
                <h2 class='title'>
                    <a href="{{ route('post.show', $post->id) }}" class="post-link">{{ $post->title }}</a>
                </h2>
                <p class='body'>{{ $post->body }}</p>
    
                <div class="post-actions">
                    <div class="post-actions-left">
                        <button type="button" onclick="toggleLike(event, {{ $post->id }})" class="like-button @if($post->liked) active @endif" data-post-id="{{ $post->id }}">
                            &#x1F44D;
                        </button>
                        <span class="like-text @if($post->liked) active @endif">{{ $post->likes_count }}</span>
                    </div>
                    <button type="button" onclick="toggleComments({{ $post->id }})">コメント</button>
                    <button type="button" onclick="saveForLater({{ $post->id }})" class="save-button @if(auth()->user()->hasSavedPost($post->id)) active @endif" data-post-id="{{ $post->id }}">
                        @if(auth()->user()->hasSavedPost($post->id))
                            後で答える
                        @else
                            後で答える
                        @endif
                    </button>
                </div>
    
                <div id="comments-container-{{ $post->id }}" class="comments" data-post-id="{{ $post->id }}" style="display: none;">
                    @foreach ($post->comments as $comment)
                        <p>{{ $comment->body }}</p>
                    @endforeach
                    <form onsubmit="submitComment(event, {{ $post->id }})">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea name="body" rows="3" placeholder="コメントを入力してください"></textarea>
                        <button type="submit">コメントする</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>


    <script>
    
    function toggleLike(event, postId) {
    const likeButton = event.currentTarget;
    const likeText = document.querySelector(`.like-text[data-post-id="${postId}"]`);

    likeButton.classList.toggle('active');
    likeText.classList.toggle('active');

    // ここで、サーバー上でいいねのステータスを更新するためのAJAXリクエストを行う
    axios.post('/like/' + postId)
        .then(response => {
            // サーバーからの応答に応じて必要な処理を追加できます
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
    
    function toggleFollow(event, userId) {
        console.log('toggleFollow function called with userId:', userId);

        // ここでサーバーにフォロー情報を送信するためのAJAXリクエストを行います
        axios.post(`/follow/${userId}`)
            .then(response => {
                if (response.data.success) {
                    // サーバーからの応答に基づいてボタンの表示を切り替えるなどの処理を行います
                    const followButton = event.currentTarget;
                    followButton.classList.toggle('active');
                    if (followButton.classList.contains('active')) {
                        followButton.textContent = 'フォロー中';
                    } else {
                        followButton.textContent = 'フォローする';
                    }
                } else {
                    // サーバーからの応答がエラーだった場合の処理を行います
                    console.error(response.data.message);
                }
            })
            .catch(error => {
                // エラーハンドリングが必要な場合の処理を行います
                console.error('Error:', error);
            });

        event.stopPropagation();
        event.preventDefault();
    }

    function toggleComments(postId) {
        const commentsDiv = document.getElementById(`comments-container-${postId}`);
        commentsDiv.style.display = (commentsDiv.style.display === 'none' || commentsDiv.style.display === '') ? 'block' : 'none';
    }

    function submitComment(event, postId) {
        // コメントの提出処理はここで処理します
        event.preventDefault();
        console.log('Comment submitted for post ID:', postId);
    }
    
    function saveForLater(postId) {
        axios.post(`/save/${postId}`)
            .then(response => {
                if (response.data.success) {
                    const saveButton = document.querySelector(`.save-button[data-post-id="${postId}"]`);
                    saveButton.classList.toggle('active');
                    if (saveButton.classList.contains('active')) {
                        saveButton.textContent = '保存済み';
                    } else {
                        saveButton.textContent = '保存';
                    }
                } else {
                    console.error(response.data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
</x-app-layout>
