@extends('layouts.app')
@section('content')
<div class="login">
  <h2>ログインページ</h2>
  <form class="form" method="POST" action="{{ route('user.login') }}">
    @csrf
    @error('error')
    <p class="error">{{ $message }}</p>
    @enderror
    @error('status')
    <p class="error">{{ $message }}</p>
    @enderror
    @error('email')
    <p class="error">{{ $message }}</p>
    @enderror
    <div class="email">
      <label>メールアドレス</label>
      <input class="email" name="email" type="text" placeholder="メール" value="{{ old('email') }}">
    </div>
    @error('password')
    <p class="error">{{ $message }}</p>
    @enderror
    <div class="パスワード">
      <label>パスワード</label>
      <input class="password" name="password" type="password" placeholder="パスワード">
    </div>
    <input class="button" type="submit" value="ログイン">
  </form>
</div>
@endsection

<style>
  .login {
    text-align: center;
    width: 50%;
    margin: 0 auto;
  }
  .form {
    display: flex;
    flex-direction: column;
  }
  .email,
  .password {
    margin-bottom: 10px;
  }
</style>
