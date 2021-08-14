@extends('app')
@section('content')
    <div class="popup @if(session('authError'))flex @else hide @endif" id="popup">
        <div class="content">
            <p class="text">{{ session('authError') }}</p>
            <button class="close" id="close">閉じる</button>
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
                <input class="field" name="email" type="text" placeholder="メール" value="{{ old('email') }}">
            </div>
            <div class="list password">
                <label class="field-name">パスワード</label>
                <input class="field" name="password" type="password" placeholder="パスワード">
            </div>
            <input class="btn" type="submit" value="ログイン">
        </form>
        <div class="sns">
            <a class="google" href="{{ route('login.sns', ['sns' => 'google']) }}">Googleでログインする</a>
            <a class="facebook" href="{{ route('login.sns', ['sns' => 'facebook']) }}">Facebookでログインする</a>
        </div>
    </div>
@endsection
