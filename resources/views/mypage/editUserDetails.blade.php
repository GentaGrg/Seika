@extends('layouts.app')

@section('content')
    <!-- ページのコンテンツ -->
    <div>
        <form action="{{ route('updateUserDetails') }}" method="post">
            @csrf
            @method('PUT')

            <p style="margin-bottom: 10px;">
                名前: <input type="text" name="name" value="{{ $user->name }}">
            </p>
            <!-- 他のフォームフィールドも追加 -->

            <button type="submit">情報を更新</button>
        </form>
    </div>
@endsection
