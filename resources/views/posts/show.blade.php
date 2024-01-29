<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('index') }}" class="back-link">&#8592;</a>
    </x-slot>

    <style>
        .twitter-style-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .twitter-style-header {
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            position: relative;
        }

        .twitter-style-header .user-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .twitter-style-header .user-info .user-name {
            margin-right: 10px;
            color: black;
        }

        .twitter-style-header .edit-svg {
            width: 20px;
            height: 20px;
            cursor: pointer;
            fill: black;
        }

        .twitter-style-header .edit-svg:hover {
            fill: #157BBB;
        }

        .twitter-style-header .edit-svg-container {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
        }

        .twitter-style-header .actions {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            flex-direction: column;
            gap: 10px;
        }

        .twitter-style-header .actions button {
            display: block;
            width: 100%;
            text-align: left;
        }

        .twitter-style-body {
            padding: 10px 0;
        }
        
        .user-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    
        .user-info .user-name {
            margin-right: 10px;
            color: black;
        }
    
        .edit-svg-container {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
        }
    
        .edit-svg:hover {
            fill: #157BBB;
        }
    
        .actions {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            flex-direction: column;
            gap: 10px;
            animation: slideIn 0.3s ease-out;
        }
    
        /* 追加されたいいね、コメントのスタイル */
        .like-comment-save-section {
            display: flex;
            gap: 10px;
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

        .comment-button.active {
            background-color: #1877f2;
            color: white;
        }
    
        .comment-button {
            background-color: white;
            border: 1px solid #1877f2;
            color: #1877f2;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
        }
        .like-comment-save-section {
            display: flex;
            gap: 10px;
        }

        .like-button,
        .comment-button,
        .save-button {
            background-color: white;
            border: 1px solid #1877f2;
            color: #1877f2;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .like-button.active,
        .comment-button.active,
        .save-button.active {
            background-color: #1877f2;
            color: white;
        }

        .comments-container {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 5px;
        }
    
        .comments-container textarea {
            width: 100%;
            margin-top: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }
    
        .comments-list {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }
    
        .comment {
            margin-top: 10px;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .comment .user-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comment .user-info .user-name {
            margin-right: 10px;
            color: black;
        }

        .comment .like-comment-save-section {
            display: flex;
            gap: 10px;
        }

        .comment .like-button,
        .comment .comment-button,
        .comment .save-button {
            background-color: white;
            border: 1px solid #1877f2;
            color: #1877f2;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .comment .like-button.active,
        .comment .comment-button.active,
        .comment .save-button.active {
            background-color: #1877f2;
            color: white;
        }

        .twitter-style-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }

        .twitter-style-footer a {
            text-decoration: none;
            color: #1DA1F2;
        }

        .twitter-style-footer a:hover {
            text-decoration: underline;
        }

        .back-link {
            margin-right: 20px;
            text-decoration: none;
            color: black;
            font-size: 30px;
            font-weight: bold;
        }

        .photo-area {
            margin-top: 20px;
            overflow: hidden;
        }

        .photo-area img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .actions {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            flex-direction: column;
            gap: 10px;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .text-wrapper {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .text-wrapper span {
            margin-left: 5px;
        }
    </style>

    <div class="twitter-style-container">
        @if (Auth::check())
            <div class="twitter-style-header">
                <div class="user-info">
                    <p class='user-time-info'>
                        @if ($post->user)
                            <span class="user-name">{{ $post->user->name }},</span>
                        @else
                            <span class="user-name">Anonymous,</span>
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
                    <div class="edit-svg-container">
                        <div class="actions">
                            <div class="text-wrapper">
                                <button onclick="editAction()">編集</button>
                            </div>
                            <div class="text-wrapper">
                                <button onclick="answerLaterAction({{ $post->id }})">後で解答</button>
                            </div>
                        </div>
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="edit-svg" onclick="toggleActions()">
                            <g>
                                <path d="M3 12c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm9 2c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm7 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"></path>
                            </g>
                        </svg>
                    </div>
                </div>
                <h1 class="title">{{ $post->title }}</h1>
            </div>
        @endif
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
            <div class="like-comment-save-section">
                <button type="button" class="like-button @if($post->isLikedBy(auth()->user())) active @endif" onclick="toggleLike(event, {{ $post->id }})">いいね</button>
                <button type="button" class="comment-button" onclick="toggleComments({{ $post->id }})">コメント</button>
                <button type="button" onclick="answerLaterAction({{ $post->id }})" class="save-button @if(auth()->user()->hasSavedPost($post->id)) active @endif" data-post-id="{{ $post->id }}">
                    後で答える
                </button>
            </div>
            <!-- コメントセクション -->
            <div id="comments-container-{{ $post->id }}" class="comments-container">
                <form action="{{ route('comment.store', ['post' => $post->id]) }}" method="post">
                    @csrf
                    <textarea name="body" placeholder="コメントを入力してください"></textarea>
                    <button type="submit">コメントする</button>
                </form>
            </div>
            <div class="comments-list">
                @foreach($post->comments as $comment)
                    <div class="comment">
                    </div>
                @endforeach
            </div>
        </div>
            @foreach($post->comments as $comment)
                <div class="comment">
                    <div class="user-info">
                        <span class="user-name">{{ $comment->user->name }},</span>
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                    <p class="body">{{ $comment->body }}</p>
                    <div class="like-comment-save-section">
                        <button type="button" class="like-button" onclick="toggleLike(event, {{ $comment->id }})">いいね</button>
                        <button type="button" class="comment-button" onclick="toggleComments({{ $comment->id }})">コメント</button>
                        <button type="button" onclick="saveForLaterComment({{ $comment->id }})" class="save-button @if(auth()->user()->hasSavedComment($comment->id)) active @endif" data-comment-id="{{ $comment->id }}">
                            後で答える
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function toggleLike(event, postId) {
            const likeButton = event.currentTarget;
            likeButton.classList.toggle('active');

            // サーバー上でいいねのステータスを更新するためのAJAXリクエストを行う
            axios.post('/like/' + postId)
                .then(response => {
                    // サーバーからの応答に応じて必要な処理を追加できます
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function toggleComments(postId) {
            const commentsDiv = document.getElementById(`comments-container-${postId}`);
            commentsDiv.style.display = (commentsDiv.style.display === 'none' || commentsDiv.style.display === '') ? 'block' : 'none';
        }

        function submitComment(event, postId) {
            // コメントの提出処理はここで処理します
            event.preventDefault();
            console.log('Post ID:', postId);
    
            const commentTextarea = document.querySelector(`comments-container-${postId} textarea`);
            const commentBody = commentTextarea.value;
    
            axios.post(`/comment`, {
                post_id: postId,
                body: commentBody
            })
            .then(response => {
                console.log('成功:', response.data);
                // コメントの提出後にtextareaをクリア
                commentTextarea.value = '';
            })
            .catch(error => {
                console.error('エラー:', error);
            });
        }
        
        function toggleActions() {
            const actionsContainer = document.querySelector('.actions');
            actionsContainer.style.display = (actionsContainer.style.display === 'none') ? 'flex' : 'none';
        }

        function editAction() {
            // 編集アクションの実行
            window.location.href = "{{ route('edit', ['post' => $post->id]) }}";
        }

        function answerLaterAction(postId) {
            // 後で解答アクションの実行
            axios.post(`/mypage/answer-later/${postId}`)
                .then(response => {
                    if (response.data.success) {
                        // メッセージを表示
                        alert('後で解答に保存しました！');
                        // マイページにリダイレクト
                        window.location.href = "{{ route('mypage') }}";
                    }
                })
                .catch(error => {
                    console.error('エラー:', error);
                });
        }
    </script>
</x-app-layout>