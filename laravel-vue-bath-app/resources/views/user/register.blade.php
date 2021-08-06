@extends('app')
@section('content')
    <div class="user-form register">
        <h2 class="title">新規登録ページ</h2>
        <form class="form" method="POST" action="{{ route('user.check_email') }}">
            @csrf
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label>ユーザー名</label>
                <input class="input" type="text" name="name" value="{{ old('name') }}">
            </div>
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label>メール</label>
                <input class="input" type="text" name="email" value="{{ old('email') }}">
            </div>
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label>パスワード</label>
                <input class="input" type="password" name="password">
            </div>
            @error('password_confirmation')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list password-confirm">
                <label>パスワード（確認用）</label>
                <input class="input" type="password" name="password_confirmation">
            </div>
            <input class="btn" type="submit" value="登録する">
        </form>
    </div>
@endsection
