<!-- resources/views/mypage/index.blade.php -->
<x-app-layout>
    <x-slot name="CamCon">
        mypage
    </x-slot>

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
            <p style="margin: 0;">ログインユーザー: {{ $user->name }}</p>
        </div>

        <div style="position: absolute; bottom: 0; left: 0; right: 0; border-bottom: 2px solid #ccc;"></div>
    </div>

    <div style="display: flex; margin-top: 20px; margin-bottom: 20px;">

        <div style="border-right: 3px solid #ccc; height: 80vh; margin-right: 1rem; padding-right: 1rem; margin-left: 1rem; display: flex; flex-direction: column; gap: 20px;">
            <div>
                <button type="button" onclick="toggleSection('past-posts')" style="border: 1px solid #ccc; padding: 10px; border-radius: 10px;">過去の投稿</button>
            </div>
            <div>
                <button type="button" onclick="toggleSection('liked-posts')" style="border: 1px solid #ccc; padding: 10px; border-radius: 10px;">いいね下投稿</button>
            </div>
            <div>
                <button type="button" onclick="toggleSection('commented-posts')" style="border: 1px solid #ccc; padding: 10px; border-radius: 10px;">コメントした投稿</button>
            </div>
            <div>
                <button type="button" onclick="toggleSection('hidden-posts')" style="border: 1px solid #ccc; padding: 10px; border-radius: 10px;">非表示した投稿</button>
            </div>
            <div>
                <button type="button" onclick="window.location.href='{{ route('answer-later.show', ['post' => $latestPost->id]) }}'" style="border: 1px solid #ccc; padding: 10px; border-radius: 10px;">後で解答</button>
            </div>

            <script>
                function toggleSection(sectionId) {
                    // すべてのセクションを非表示にする
                    document.getElementById('past-posts-section').style.display = 'none';
                    document.getElementById('liked-posts-section').style.display = 'none';
                    document.getElementById('commented-posts-section').style.display = 'none';
                    document.getElementById('hidden-posts-section').style.display = 'none';
                    document.getElementById('saved-for-later-section').style.display = 'none';

                    // 選択されたセクションを表示する
                    document.getElementById(sectionId + '-section').style.display = 'block';
                }
            </script>
        </div>

        <div style="position: relative; display: flex; flex-direction: column; align-items: center; width: 300px;">

            <!-- バックグラウンド画像 -->
            <div style="width: 100%; height: 200px; background-image: url('{{ $user->background_picture_url ?? asset('images/default_background.jpg') }}'); background-size: cover; background-position: center; margin-bottom: 20px; position: relative;">
                <input type="file" name="background_picture" accept="image/*" style="position: absolute; bottom: 0; right: 0; cursor: pointer; opacity: 0;" onchange="changeImage(this, 'background-image');">
                <span id="backgroundImageText" style="position: absolute; bottom: 5px; right: 5px; color: black; font-weight: bold; cursor: pointer;" onclick="changeImageInput('background_picture', 'background-image')">追加</span>
            </div>

            <!-- プロフィール画像 -->
            <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; position: relative; margin-bottom: 10px;">
                <img src="{{ $user->profile_picture_url ?? asset('images/default_profile.jpg') }}" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                <input type="file" name="profile_picture" accept="image/*" style="position: absolute; bottom: 0; right: 0; cursor: pointer; opacity: 0;" onchange="changeImage(this, 'profile-image');">
                <span id="profileImageText" style="position: absolute; bottom: 5px; right: 5px; color: black; font-weight: bold; cursor: pointer;" onclick="changeImageInput('profile_picture', 'profile-image')">追加</span>
            </div>

            <div style="margin-top: 20px;">
                <button type="button" onclick="openModal('following-modal')">フォロー中</button>
                <button type="button" onclick="openModal('followers-modal')">フォロワー</button>
            </div>

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
            <hr style="border-top: 2px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

            <p style="margin-bottom: 10px;">ポイント残高: {{ $user->point->amount ?? 0 }}</p>
            <p style="margin-bottom: 10px;">ご利用可能ポイント: {{ $user->point->available_amount ?? 0 }}</p>
            <button type="submit" style="margin-top: 10px;">
                <span style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; font-size: 16px;">ポイント消費履歴</span>
            </button>
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

            <div id="following-modal" style="display: none;">
                <h2>フォロー中 ({{ $user->following()->count() }})</h2>
                <ul>
                    @foreach($user->following as $followingUser)
                        <li>{{ $followingUser->name }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- フォロワーのモーダル -->
            <div id="followers-modal" style="display: none;">
                <h2>フォロワー ({{ $user->followers()->count() }})</h2>
                <ul>
                    @foreach($user->followers as $followerUser)
                        <li>{{ $followerUser->name }}</li>
                    @endforeach
                </ul>
            </div>

            <script>
                function openModal(modalId) {
                    document.getElementById(modalId).style.display = 'block';
                }

                // 画像が変更されたことを示す変数
                var backgroundImageChanged = false;
                var profileImageChanged = false;

                function changeImageInput(inputName, imageType) {
                    document.querySelector(`input[name="${inputName}"]`).click();
                }

                function changeImage(input, imageType) {
                    const file = input.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            document.querySelector(`div[style*="${imageType}"]`).style.backgroundImage = `url('${e.target.result}')`;
                            document.querySelector(`img[alt="${imageType}"]`).src = e.target.result;

                            // 画像が変更されたことを示す変数を設定
                            if (imageType === 'background-image') {
                                backgroundImageChanged = true;
                            } else if (imageType === 'profile-image') {
                                profileImageChanged = true;
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                }

                // ボタンがクリックされたときの処理
                function handleButtonClick() {
                    // 変更された画像がある場合の処理
                    if (backgroundImageChanged) {
                        console.log('バックグラウンド画像が変更されました');
                        // ここに画像を保存するための処理を追加
                    }
                    if (profileImageChanged) {
                        console.log('プロフィール画像が変更されました');
                        // ここに画像を保存するための処理を追加
                    }
                }
            </script>
        </div>
    </div>
</x-app-layout>
