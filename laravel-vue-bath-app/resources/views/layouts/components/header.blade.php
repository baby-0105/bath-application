<header class="header">
  <a href="{{ url('/') }}">OfLog</a>
  <div class="nav">
    @if(Auth::check())
      <p>{{ Auth::user()->name }}</p>
      <a class="blue-link" href="{{ route('logout') }}">ログアウト</a>
    @else
    <div>
      <a href="{{ url('/user/register') }}">新規登録</a>
      <a href="{{ url('/user/login') }}">ログイン</a>
    </div>
    @endif
  </div>
</header>

<style>
  .header{
    display: flex;
    justify-content: space-between;
    padding: 20px;
  }
  .header .nav{
    display: flex;
  }
</style>
