<x-app-layout>
    <x-slot name="header">
    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
      <button onclick="window.location='{{ route('index') }}'" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px; cursor: pointer;">キャンセル</button>
      <button onclick="window.location='{{ route('index') }}'" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px; cursor: pointer;">CampusConnect</button>
      <button type="submit" form="postForm" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px; cursor: pointer;">投稿</button>
    </div>
    </x-slot>

    @if(Auth::check())
    <!-- ユーザーがログインしている場合に表示されるコンテンツ -->
    {{-- カテゴリー選択フォーム --}}
    <form action="{{ route('store') }}" method="post" id="postForm">
    @csrf
   <div style="width: 80%; margin: 0 auto; margin-top: 50px; text-align: center;">
    <div style="display: flex; justify-content: space-between; align-items: center;">

        <!-- タイトル -->
        <div style="flex: 1; text-align: center; margin-left: 50px; margin-right: 50px;">
            <label for="title" style="display: block; font-size: 18px;">タイトル</label>
            <input type="text" name="post[title]" id="title" required style="width: 50%; font-size: 16px;">
        </div>

        <!-- カテゴリー -->
        <div style="flex: 1; text-align: center; margin-left: -50px; margin-right: 50px;">
            <label for="category" style="display: block; font-size: 16px;">カテゴリー</label>
            <select name="post[category_id]" id="category" required style="font-size: 16px;" onchange="adjustSelectWidth(this)">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

        
    <div style="margin-top: 40px; margin-bottom: 30px; text-align: center;">

    <div style="margin-top: 40px; margin-bottom: 30px; text-align: center;">
    <label for="body" style="display: block; font-size: 18px; margin-bottom: 10px;">内容</label>
    <textarea name="post[body]" id="body" rows="5" required style="width: 50%; height: 400px; font-size: 16px; margin-bottom: 10px;"></textarea>

    <!-- ファイル添付 -->
    <form id="postForm" method="POST" action="{{ route('your_upload_action') }}" enctype="multipart/form-data">
    <!-- 他のフォーム要素 -->

    <!-- 写真を添付する -->
    <div>
        <label for="fileAttachment" style="display: block; font-size: 16px; margin-top: 10px;">写真やファイルを添付する</label>
        <input type="file" id="fileAttachment" name="post[file_attachment]" accept="image/*, .pdf, .doc, .docx" style="font-size: 16px; margin-top: 5px;">
    </div>
    
    <!-- 送信ボタン -->
    <div style="margin: 30px auto; text-align: center;">
        <button type="submit" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px; cursor: pointer;">投稿</button>
    </div>
    </form>


    <div id="imageDisplayArea" style="text-align: center;">
        <!-- アップロード写真が表示 -->
    </div>

    <div style="margin: 40px auto; text-align: center;">
    <a href="{{ route('myposts') }}">
        <span style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; font-size: 16px;">投稿一覧に戻る</span>
    </a>
　　</div>

　　<script>
    function onCancelClick() {
        var userInput = document.getElementById('postForm').elements['post[title]'].value; // ユーザーが入力した内容を取得

        if (userInput.trim() !== '') {
            // ユーザーが何か入力している場合、確認メッセージを表示
            var confirmation = confirm('入力した内容が消えますが本当に戻りますか？');
            if (!confirmation) {
                return; // キャンセルされたら何もせずに終了
            }
        }

        // キャンセル時の処理
        window.location = '{{ route('home') }}';
    }
　　</script>

        <script>
    // カテゴリー選択時の幅調整
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
