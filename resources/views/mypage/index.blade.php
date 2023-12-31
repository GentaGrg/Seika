<!-- resources/views/mypage/index.blade.php -->
<x-app-layout>
    <x-slot name="CamCon">
        mypage
    </x-slot>

    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0 1rem; position: relative;">
        <div>
            <!-- CampusConnect -->
            <h1 style="border-bottom: 3px solid #ccc; font-size: 2em; margin: 0;">CampusConnect</h1>
            <!-- マイページの下に横に長い下線 -->
            <p style="border-bottom: 2px solid #ccc; display: inline-block; padding-top: 5px; margin-top: 5px; margin-left: 9rem; font-size: 30px;">マイページ</p>
        </div>

    <div style="display: flex; align-items: center; gap: 1rem; margin-left: auto;">
            <!-- ホームへのリンク -->
        <a href="#" style="margin-right: 1rem;">ホーム</a>
            <!-- 通知へのリンク -->
        <a href="#">通知</a>
            <!-- リンクとユーザー情報の間にスペースを追加 -->
        <div style="margin-right: 1rem;"></div>
        <p style="margin: 0;">ログインユーザー: {{ $user->name }}</p>
    </div>

        <!-- キャンパスコネクトの下線までの線 -->
        <div style="position: absolute; bottom: 0; left: 0; right: 0; border-bottom: 2px solid #ccc;"></div>
    </div>

    <div style="display: flex; margin-top: 20px; margin-bottom: 20px;">
    <!-- Vertical line with increased height -->
    <div style="border-right: 3px solid #ccc; height: 80vh; margin-right: 1rem; padding-right: 1rem; margin-left: 1rem;">
        <!-- Navigation labels -->
        <p style="margin-bottom: 20px;">過去の投稿</p>
        <p style="margin-bottom: 20px;">いいね下投稿</p>
        <p style="margin-bottom: 20px;">コメントした投稿</p>
        <p style="margin-bottom: 20px;">非表示した投稿</p>
    </div>
                <!-- Additional information with points and history -->
　　<div style="position: relative;">

    <!-- ポイント関連の情報 -->
    <p style="margin-bottom: 10px;">ポイント残高: 00</p>
    <p style="margin-bottom: 10px;">ご利用可能ポイント: 00</p>

    <!-- ポイント消費履歴を小さい四角で囲む -->
    <button type="submit" style="margin-top: 10px;">
    <span style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; font-size: 16px;">ポイント消費履歴</span>
   </button>
    <!-- 下に横長い線を引く -->
    <div style="border-top: 2px solid #ccc; margin-top: 20px;"></div>

    <!-- 累計質問いいね解決コメント -->
    <div style="margin-top: 20px; margin-bottom: 20px; display: flex;">
    <div style="margin-right: 5px; padding-right: 5px;">
        <p style="margin-bottom: 10px; font-weight: bold;">累計</p>
    </div>
    <div style="text-align: right; margin-right: 20px; border-right: 1px solid #ccc; padding-right: 20px;">
        <p style="margin-bottom: 10px;">質問数: </p>
    </div>
    <div style="text-align: right; margin-right: 20px; border-right: 1px solid #ccc; padding-right: 20px;">
        <p style="margin-bottom: 10px;">いいね数: </p>
    </div>
    <div style="text-align: right; margin-right: 20px; border-right: 1px solid #ccc; padding-right: 20px;">
        <p style="margin-bottom: 10px;">解決数: </p>
    </div>
    <div style="text-align: right;">
        <p style="margin-bottom: 10px;">コメント数: </p>
    </div>
　　</div>
 
    <hr style="border-top: 2px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

<!-- 個人情報 -->
<div>
    <p style="margin-bottom: 10px;">名前: {{ $user->name }}</p>
    <p style="margin-bottom: 10px;">ニックネーム: {{ $user->nickname }}</p>
    <p style="margin-bottom: 10px;">生年月日: {{ $user->birthdate }}</p>
    <p style="margin-bottom: 10px;">所属大学: {{ $user->university }}</p>
    <p style="margin-bottom: 10px;">学年: {{ $user->grade }}</p>
    <p style="margin-bottom: 10px;">学部: {{ $user->faculty }}</p>
</div>
</div>
</x-app-layout>