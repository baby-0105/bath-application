@extends('layouts.app')
@section('content')
<div class="login">
  <h2>ログインページ</h2>
  <form class="form" action="">
    <input class="email" type="text" placeholder="メール">
    <input class="pass" type="password" placeholder="パスワード">
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
