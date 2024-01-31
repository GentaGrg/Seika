<x-app-layout>
    <x-slot name="CamCon">
        mypage
    </x-slot>

    <!-- ここに後で解答ボタンを押して表示させたいコンテンツを記述 -->
    <div class="twitter-style-container">
        <!-- 投稿の内容を表示 -->
        <div class="twitter-style-header">
            <!-- 投稿ヘッダー -->
            <!-- ここにユーザー情報や編集ボタンを表示 -->
        </div>
        <div class="twitter-style-body">
            <!-- 投稿の本文 -->
            <div class="content">
                <div class="content_post">
                    <h3>本文</h3>
                    <p class='body'>{{ $post->body }}</p>
                </div>
            </div>
        </div>
        <div class="photo-area">
            <!-- 画像表示 -->
            <img src="https://placekitten.com/600/400" alt="Photo">
        </div>
        <div class="twitter-style-footer">
            <!-- ボタンやアクション表示 -->
            <div class="like-comment-save-section">
                <button type="button" class="like-button">いいね</button>
                <button type="button" class="comment-button">コメント</button>
                <button type="button" onclick="saveForLater({{ $post->id }})" class="save-button @if(auth()->user()->hasSavedPost($post->id)) active @endif" data-post-id="{{ $post->id }}">
                    後で答える
                </button>
            </div>
        </div>
    </div>

    <script>
        // ここにスクリプトがあれば追加
    </script>
</x-app-layout>
