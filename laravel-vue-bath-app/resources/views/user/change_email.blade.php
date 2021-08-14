@extends('app')
@section('content')
    <div class="user-form change-email">
        <h2 class="title">メールアドレス変更</h2>
        <form class="form" method="POST" action="">
            @csrf
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label class="field-name">現在のメールアドレス</label>
                <input class="field" type="text" name="email" value="{{ old('email') }}">
            </div>
            @error('new-email')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label class="field-name">新しいメールアドレス</label>
                <input class="field" type="text" name="new-email" value="{{ old('new-email') }}">
            </div>
            @error('new-email-confirmation')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label class="field-name">新しいメールアドレス（確認用）</label>
                <input class="field" type="text" name="new-email-confirmation" value="{{ old('new-email-confirmation') }}">
            </div>
            <input class="btn" type="submit" value="登録する">
        </form>
        <div class="other-links">
            <a href="{{ route('user.edit.show') }}" class="link">ユーザー情報を変更する</a>
            <a href="{{ route('user.change_password') }}" class="link">パスワードを変更する</a>
        </div>
    </div>
@endsection
