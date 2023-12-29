<!-- resources/views/mypage/index.blade.php -->
<x-app-layout>
    <x-slot name="CamCon">
        mypage
    </x-slot>

    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0 1rem;">
        <h1 style="border-bottom: 2px solid #ccc; font-size: 2em; margin: 0;">マイページ</h1>

        <div style="text-align: right;">
            <p style="margin: 0;">ログインユーザー: {{ $user->name }}</p>
        </div>
    </div>

    <div style="margin-top: 20px; margin-bottom: 20px; margin-right: 20px;">
        <!-- 追加の情報 -->
        <p style="margin-bottom: 10px;">名前: {{ $user->name }}</p>
        <p style="margin-bottom: 10px;">ニックネーム: {{ $user->nickname }}</p>
        <p style="margin-bottom: 10px;">生年月日: {{ $user->birthdate }}</p>
        <p style="margin-bottom: 10px;">所属大学: {{ $user->university }}</p>
        <p style="margin-bottom: 10px;">学年: {{ $user->grade }}</p>
        <p style="margin-bottom: 10px;">学部: {{ $user->faculty }}</p>
    </div>
</x-app-layout>
