<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <h1>自分の投稿一覧</h1>

    @if($userPosts && count($userPosts) > 0)
        @foreach($userPosts as $post)
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->body }}</p>
        @endforeach
    @else
        <p>投稿がありません。</p>
    @endif

    <a href="{{ route('index') }}">ホームに戻る</a>
</x-app-layout>
