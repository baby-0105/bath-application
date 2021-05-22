@extends('layouts.app')
@section('content')
<div class="register">
  <h2 class="title">新規登録ページ</h2>
  <form class="form" method="POST" action="{{ route('user.check_email') }}">
    @csrf
    @error('name')
    <p class="error">{{ $message }}</p>
    @enderror
    <div class="name">
      <label>ユーザー名</label>
      <input type="text" name="name" value="{{ old('name') }}">
    </div>
    @error('email')
    <p class="error">{{ $message }}</p>
    @enderror
    <div class="email">
      <label>メール</label>
      <input type="text" name="email" value="{{ old('email') }}">
    </div>
    @error('password')
    <p class="error">{{ $message }}</p>
    @enderror
    <div class="password">
      <label>パスワード</label>
      <input type="password" name="password">
    </div>
    @error('password_confirmation')
    <p class="error">{{ $message }}</p>
    @enderror
    <div class="password">
      <label>パスワード（確認用）</label>
      <input type="password" name="password_confirmation">
    </div>
    <input class="button" type="submit" value="登録する">
  </form>
</div>
@endsection

<style>
  .register {
    width: 50%;
    margin: 0 auto;
  }
  .title {
    text-align: center;
  }
  .form {
    display: flex;
    flex-direction: column;
  }
  .name,
  .email,
  .pic,
  .password {
    margin-bottom: 10px;
  }
</style>