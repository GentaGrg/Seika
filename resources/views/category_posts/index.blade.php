<h1 style="border-bottom: 3px solid #ccc; font-size: 2em; margin: 0;">CampusConnect</h1>

<a href="{{ route('mypage') }}">
    @if (Route::is('mypage'))
        <h1 style="border-bottom: 2px solid #ccc;">マイページ</h1>
    @else
        <h1 style="border-bottom: 2px solid #ccc;">マイページ</h1>
    @endif
</a>
    <h1>カテゴリーの投稿一覧</h1>

    @foreach ($categoryPosts as $post)
        <div class='post'>
            <h2 class='title'><a href="{{ route('show', $post->id) }}">{{ $post->title }}</a></h2>
            <p class='body'>{{ $post->body }}</p>
        </div>
    @endforeach