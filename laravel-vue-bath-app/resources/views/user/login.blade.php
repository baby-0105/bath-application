@extends('layouts.app')
@section('content')
<div class="login">
    <h2 class="title">ログインページ</h2>
    <form class="form" method="POST" action="{{ route('user.login') }}">
        @csrf
        @error('error')    <p class="error">{{ $message }}</p> @enderror
        @error('status')   <p class="error">{{ $message }}</p> @enderror
        @error('email')    <p class="error">{{ $message }}</p> @enderror
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <div class="list">
            <label>メールアドレス</label>
            <input class="input" name="email" type="text" placeholder="メール" value="{{ old('email') }}">
        </div>
        <div class="list password">
            <label>パスワード</label>
            <input class="input" name="password" type="password" placeholder="パスワード">
        </div>
        <input class="btn" type="submit" value="ログイン">
    </form>
    <div class="sns">
        <a class="google" href="/login/google">Googleでログインする</a>
        <a class="facebook" href="/auth/login/facebook">Facebookでログインする</a>
    </div>
</div>
@endsection

<style>
</style>
