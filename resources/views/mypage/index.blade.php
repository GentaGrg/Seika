<!-- resources/views/mypage/index.blade.php -->
<x-app-layout>
    <x-slot name="CamCon">
        mypage
    </x-slot>

    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0 1rem; position: relative;">
        <div>
            <!-- CampusConnect -->
            <h1 style="border-bottom: 3px solid #ccc; font-size: 2em; margin: 0;">CampusConnect</h1>
            
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
    <p style="margin-bottom: 10px;">名前: {{ $user->name }}</p>
    <p style="margin-bottom: 10px;">ニックネーム: {{ $user->nickname }}</p>
    <p style="margin-bottom: 10px;">生年月日: {{ $user->birthdate }}</p>
    <p style="margin-bottom: 10px;">所属大学: {{ $user->university }}</p>
    <p style="margin-bottom: 10px;">学年: {{ $user->grade }}</p>
    <p style="margin-bottom: 10px;">学部: {{ $user->faculty }}</p>
</div>
<button type="button" id="registrationButton" style="margin-top: 10px;">
    <span style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; font-size: 16px;">登録ボタン</span>
</button>
</div>
</x-app-layout>