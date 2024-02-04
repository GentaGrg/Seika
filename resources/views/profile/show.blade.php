<!-- resources/views/profile/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $user->name }} のプロフィール</h1>
        <p>Bio: {{ $profile->bio }}</p>
        <p>Avatar: <img src="{{ $profile->avatar }}" alt="Avatar"></p>
    </div>
@endsection
