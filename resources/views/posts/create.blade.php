<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: center; align-items: center; width: 100%;">
            <button onclick="window.location='{{ route('index') }}'" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px; cursor: pointer;">CampusConnect</button>
        </div>
    </x-slot>

    @if(Auth::check())
        <!-- ユーザーがログインしている場合に表示されるコンテンツ -->
        {{-- カテゴリー選択フォーム --}}
        <form action="{{ route('store') }}" method="post">
            @csrf
            <div class="form-group" style="margin-bottom: 40px; margin-top: 50px; text-align: center;">
                <label for="category" style="display: block; font-size: 16px;">カテゴリー</label>
                <select name="post[category_id]" id="category" required style="font-size: 16px; text-align: center;" onchange="adjustSelectWidth(this)">
                    @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
                </select>
            </div>

            <div style="text-align: center; margin-bottom: 40px;">
                <label for="title" style="display: block; font-size: 18px;">タイトル</label>
                <input type="text" name="post[title]" id="title" required style="width: 80%; margin: 0 auto; font-size: 16px;">
            </div>

            {{-- 本文入力フォーム --}}
            <div style="margin-top: 40px; margin-bottom: 30px; text-align: center;">
                <label for="body" style="display: block; font-size: 18px;">本文</label>
                <textarea name="post[body]" id="body" rows="5" required style="width: 80%; font-size: 16px;"></textarea>
            </div>

            {{-- 送信ボタン --}}
            <div style="margin: 30px auto; text-align: center;">
                <input type="submit" value="保存"/>
            </div>
        </form>

        <div style="margin: 40px auto; text-align: center;">
    <a href="{{ route('myposts') }}">
        <span style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; font-size: 16px;">投稿一覧に戻る</span>
    </a>
</div>

        <script>
            function adjustSelectWidth(selectElement) {
                var maxWidth = 17;
                for (var i = 0; i < selectElement.options.length; i++) {
                    maxWidth = Math.max(maxWidth, selectElement.options[i].text.length);
                }
                var newWidth = maxWidth * 8 + 17; 
                selectElement.style.width = newWidth + 'px';
            }
        </script>

        <script>
            // カテゴリー選択時に表示を更新
            document.getElementById('category').addEventListener('change', function() {
                var selectedCategory = document.getElementById('category').value;
                document.getElementById('selectedCategory').innerText = selectedCategory;
            });
        </script>

        <style>
            .form-group {
                margin-bottom: 20px;
            }
        </style>
    @else
        <!-- ユーザーがログインしていない場合に表示されるコンテンツ -->
        <p>ログインしてください。</p>
    @endif
</x-app-layout>
