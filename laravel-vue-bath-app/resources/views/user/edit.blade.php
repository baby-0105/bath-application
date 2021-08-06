@extends('app')
@section('content')
    <div class="user-form user-edit">
        <h2 class="title">ユーザー情報編集ページ</h2>
        <form class="form" method="POST" action="">
            @csrf
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label>ユーザー名</label>
                <input class="input" type="text" name="name" value="{{ old('name') }}">
            </div>
            @error('img')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label>プロフィール画像</label>
                <input class="input" type="file" name="img" value="{{ old('img') }}">
            </div>
            @error('prefecture')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label>都道府県</label>
                <select class="select" name="prefecture">
                    <option>大阪</option>
                    <option>東京</option>
                </select>
            </div>
            @error('introduce')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list password-confirm">
                <label>パスワード（確認用）</label>
                <textarea class="input" type="text" name="introduce"></textarea>
            </div>
            <input class="btn" type="submit" value="登録する">
        </form>
        <div class="other-links">
            <a href="{{ route('user.change_password') }}" class="link">パスワードを変更する</a>
            <a href="{{ route('user.change_email') }}" class="link">メールアドレスを変更する</a>
        </div>
    </div>
@endsection
