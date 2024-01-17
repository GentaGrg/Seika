<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CamCon') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($all_users as $user)
                    <div class="card">
                        <div class="card-header p-3 w-100 d-flex">
                            <img src="{{ $user->profile_image }}" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $user->name }}</p>
                                <a href="{{ url('users/' . $user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                            </div>
                            <!-- フォローされている場合の表示 -->
                            @if (auth()->user()->isFollowed($user->id))
                                <div class="px-2">
                                    <span class="px-1 bg-secondary text-light">フォローされています</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-end flex-grow-1">
                                <!-- フォローしている場合の表示 -->
                                @if (auth()->user()->isFollowing($user->id))
                                    <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                                    </form>
                                @else
                                    <!-- フォローしていない場合の表示 -->
                                    <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">フォローする</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
            {{ $all_users->links() }}
        </div>
    </div>

        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0 1rem; position: relative;">
            <div>
                <!-- CampusConnect -->
                <a href="{{ route('index') }}" style="text-decoration: none; color: inherit;">
                    <h1 style="border-bottom: 3px solid #ccc; font-size: 2em; margin: 0; cursor: pointer;">CampusConnect</h1>
                </a>
                <p style="border-bottom: 2px solid #ccc; display: inline-block; padding-top: 5px; margin-top: 5px; margin-left: 9rem; font-size: 30px;">マイページ</p>
            </div>

            <div style="display: flex; align-items: center; gap: 1rem; margin-left: auto;">
                <a href="{{ route('index') }}" style="margin-right: 0rem;">ホーム</a>
                <a href="#">通知</a>
                <div style="margin-right: 1rem;"></div>
                <p style="margin: 0;">ログインユーザー: {{ auth()->user()->name }}</p>
            </div>

            <div style="position: absolute; bottom: 0; left: 0; right: 0; border-bottom: 2px solid #ccc;"></div>
        </div>

    <div style="display: flex; margin-top: 20px; margin-bottom: 20px;">
    
    <div style="border-right: 3px solid #ccc; height: 80vh; margin-right: 1rem; padding-right: 1rem; margin-left: 1rem;">
        <p style="margin-bottom: 20px;">過去の投稿</p>
        <p style="margin-bottom: 20px;">いいね下投稿</p>
        <p style="margin-bottom: 20px;">コメントした投稿</p>
        <p style="margin-bottom: 20px;">非表示した投稿</p>
    </div>
    
　　<div style="position: relative;">

    <p style="margin-bottom: 10px;">ポイント残高: 00</p>
    <p style="margin-bottom: 10px;">ご利用可能ポイント: 00</p>

    <button type="submit" style="margin-top: 10px;">
    <span style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; font-size: 16px;">ポイント消費履歴</span>
   </button>
    
    <div style="border-top: 2px solid #ccc; margin-top: 20px;"></div>

    <div style="margin-top: 20px; margin-bottom: 20px; display: flex;">
    <div style="margin-right: 5px; padding-right: 5px; text-align: center;">
        <p style="margin-bottom: 10px; font-weight: bold;">累計<br><span id="total">00</span></p>
    </div>
    <div style="text-align: right; margin-right: 20px; border-right: 1px solid #ccc; padding-right: 20px;">
    <p style="margin-bottom: 10px;">質問数<br><span id="questionCount" style="display: inline-block; text-align: center; width: 100%;">00</span></p>
　　</div>
    <div style="text-align: center; margin-right: 20px; border-right: 1px solid #ccc; padding-right: 20px;">
        <p style="margin-bottom: 10px;">いいね数<br><span id="likeCount">00</span></p>
    </div>
    <div style="text-align: center; margin-right: 20px; border-right: 1px solid #ccc; padding-right: 20px;">
        <p style="margin-bottom: 10px;">解決数<br><span id="solveCount">00</span></p>
    </div>
    <div style="text-align: center;">
        <p style="margin-bottom: 10px;">コメント数<br><span id="commentCount">00</span></p>
    </div>
　　</div>
 
    <hr style="border-top: 2px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

    <div>
        @if ($user->detailsAreRegistered())
            <!-- 登録済みの場合 -->
            <p style="margin-bottom: 10px;">名前: {{ $user->name }}</p>
            <p style="margin-bottom: 10px;">ニックネーム: {{ $user->nickname }}</p>
            <p style="margin-bottom: 10px;">生年月日: {{ $user->birthdate }}</p>
            <p style="margin-bottom: 10px;">所属大学: {{ $user->university }}</p>
            <p style="margin-bottom: 10px;">学年: {{ $user->grade }}</p>
            <p style="margin-bottom: 10px;">学部: {{ $user->faculty }}</p>
            <form action="{{ route('editUserDetails') }}" method="get">
                <button type="submit">変更</button>
            </form>
        @else
            <!-- 未登録の場合 -->
            <p>詳細情報未登録</p>
            <form action="{{ route('registerUserDetails') }}" method="post">
                @csrf
                <p style="margin-bottom: 10px;">
                    名前: <input type="text" name="name" value="{{ old('name') }}">
                </p>
                <p style="margin-bottom: 10px;">
                    ニックネーム: <input type="text" name="nickname" value="{{ old('nickname') }}">
                </p>
                <p style="margin-bottom: 10px;">
                    生年月日: <input type="date" name="birthdate" value="{{ old('birthdate') }}">
                </p>
                <p style="margin-bottom: 10px;">
                    所属大学: <input type="text" name="university" value="{{ old('university') }}">
                </p>
                <p style="margin-bottom: 10px;">
                    学年: <input type="text" name="grade" value="{{ old('grade') }}">
                </p>
                <p style="margin-bottom: 10px;">
                    学部: <input type="text" name="faculty" value="{{ old('faculty') }}">
                </p>
                <button type="submit">確定</button>
            </form>
        @endif
    </div>
    
    
    <script>
    document.getElementById('registrationButton').addEventListener('click', function() {
        // この部分にボタンがクリックされたときの処理を追加
        console.log('ボタンがクリックされました。');
        // ここに他の処理を追加することができます
    });
</script>
</x-app-layout>