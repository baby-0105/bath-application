@extends('app')
@section('content')
    <div class="popup @if(session('message'))flex @else hide @endif" id="popup">
        <div class="content">
            <p class="text">{{ session('message') }}</p>
            <button class="btn close" id="close"></button>
        </div>
    </div>
    <div class="user-form login">
        <h2 class="title">ログインページ</h2>
        <form class="form" method="POST" action="{{ route('user.login') }}">
            @csrf
            @error('error')    <p class="error">{{ $message }}</p> @enderror
            @error('status')   <p class="error">{{ $message }}</p> @enderror
            @error('email')    <p class="error">{{ $message }}</p> @enderror
            @error('password') <p class="error">{{ $message }}</p> @enderror

            <div class="list">
                <label class="field-name">メールアドレス</label>
                <input class="field" name="email" type="text" value="{{ old('email') }}">
            </div>
            <div class="list password">
                <label class="field-name">パスワード</label>
                <input class="field" name="password" type="password">
            </div>
            <button class="btn main-submit-btn" type="submit"></button>
        </form>
        <div class="sns">
            <a class="google" href="{{ route('login.sns', ['sns' => 'google']) }}">Googleでログイン</a>
            <a class="facebook" href="{{ route('login.sns', ['sns' => 'facebook']) }}">Facebookでログイン</a>
        </div>
    </div>
@endsection
