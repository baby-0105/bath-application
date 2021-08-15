@extends('app')
@section('content')
    <div class="user-form change-password">
        <h2 class="title">パスワード変更</h2>
        <form class="form" method="POST" action="{{ route('user.change_password.submit') }}">
            @csrf
            @error('current_password') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label class="field-name">現在のパスワード</label>
                <input class="field" type="password" name="current_password" value="">
            </div>
            @error('new_password') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label class="field-name">新しいパスワード</label>
                <input class="field" type="password" name="new_password" value="">
            </div>
            @error('new_password_confirmation') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label class="field-name">新しいパスワード（確認用）</label>
                <input class="field" type="password" name="new_password_confirmation" value="">
            </div>
            <input class="btn" type="submit" value="登録する">
        </form>
        <div class="other-links">
            <a href="{{ route('user.edit.show') }}" class="link">ユーザー情報を変更する</a>
            <a href="{{ route('user.change_email') }}" class="link">メールアドレスを変更する</a>
        </div>
    </div>
@endsection
