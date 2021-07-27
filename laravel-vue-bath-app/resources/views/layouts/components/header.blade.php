<header class="header">
  <a href="{{ url('/') }}">OfLog</a>
  <div class="nav">
    <img src="svg/menu.svg" class="menu-icon">
    <div class="menu-contents">
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
  </div>
</header>

<style>
  .header{
    display: flex;
    justify-content: space-between;
    padding: 20px;
  }
  .header .nav{ display: flex; }
  .menu-icon{
    width: 60px;
  }
  .menu-contents {
    display: none;
  }
</style>
