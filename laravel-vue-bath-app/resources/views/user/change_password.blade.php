@extends('app')
@section('content')
    <div class="user-form change-password">
        <h2 class="title">パスワード変更</h2>
        <form class="form" method="POST" action="">
            @csrf
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label>現在のパスワード</label>
                <input class="input" type="password" name="password" value="{{ old('password') }}">
            </div>
            @error('new-password')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label>新しいパスワード</label>
                <input class="input" type="password" name="new-password" value="{{ old('new-password') }}">
            </div>
            @error('new-password-confirmation')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label>新しいパスワード（確認用）</label>
                <input class="input" type="password" name="new-password-confirmation" value="{{ old('new-password-confirmation') }}">
            </div>
            <input class="btn" type="submit" value="登録する">
        </form>
        <div class="other-links">
            <a href="{{ route('user.edit') }}" class="link">ユーザー情報を変更する</a>
            <a href="{{ route('user.change_email') }}" class="link">メールアドレスを変更する</a>
        </div>
    </div>
@endsection
