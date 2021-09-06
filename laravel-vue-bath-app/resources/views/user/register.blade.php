@extends('app')
@section('content')
    <div class="user-form register" id="register">
        <h2 class="title">新規登録</h2>
        <form class="form" method="POST" action="{{ route('user.check_email') }}">
            @csrf
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label class="field-name">ユーザー名</label>
                <input class="field" type="text" name="name" value="{{ old('name') }}" placeholder="2〜20文字で入力してください">
            </div>
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label class="field-name">メール</label>
                <input class="field" type="text" name="email" value="{{ old('email') }}">
            </div>
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label class="field-name">パスワード</label>
                <input class="field" type="password" name="password" placeholder="8〜16文字で入力してください。">
            </div>
            @error('password_confirmation')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list password-confirm">
                <label class="field-name">パスワード（確認用）</label>
                <input class="field" type="password" name="password_confirmation" placeholder="パスワードと同じものを入力してください">
            </div>
            <button id="registerBtn" class="btn" type="submit"></button>
        </form>
        <div class="sns">
            <a class="google" href="{{ route('login.sns', ['sns' => 'google']) }}">Googleでログイン</a>
            <a class="facebook" href="{{ route('login.sns', ['sns' => 'facebook']) }}">Facebookでログイン</a>
        </div>
    </div>
@endsection
