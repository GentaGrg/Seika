<meta charset="UTF-8">
　　<title>CamCoon</title>
<x-app-layout>
    <x-slot name="CamCon">
        index
    </x-slot>
　　
    <div>
        @foreach ($posts as $post)
            {{-- 投稿の表示コード --}}
        @endforeach
    </div>

    <h1 style="border-bottom: 2px solid #ccc;">CampusConnect</h1>
    
    <div style="border: 2px solid #ccc; padding: 10px; margin-bottom: 10px;">
    <a href="{{ route('create') }}" style="display: inline-block; padding: 8px; border: 1px solid #ccc; border-radius: 5px; text-decoration: none;">質問投稿</a>
</div>

    <div class='posts'>
    @foreach ($posts as $post)
        <div class='post'>
            <h2 class='title'><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h2>
            <a href="{{ route('categories.show', $post->category->id) }}">{{ $post->category->name }}</a>
            <p class='body'>{{ $post->body }}</p>
            <form action="{{ route('posts.destroy', $post->id) }}" id="form_{{ $post->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
            </form>
        </div>
    @endforeach
    ログインユーザー:{{ Auth::user()->name }}
</div>

    <div class='paginate'>
        {{ $posts->links() }}
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
