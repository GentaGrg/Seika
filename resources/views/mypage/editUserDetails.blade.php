@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('updateUserDetails') }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">名前:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">新しいパスワード:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">確認用パスワード:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="mb-3">
                <label for="birthdate" class="form-label">生年月日:</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $user->birthdate }}">
            </div>

            <button type="submit" class="btn btn-primary">情報を更新</button>
        </form>
    </div>
@endsection