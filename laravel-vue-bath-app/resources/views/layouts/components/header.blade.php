<header class="header">
  <a href="{{ url('/') }}"><img class="logo" src="{{ url('img/OFLog-logo.png') }}" alt="ヘッダーのロゴ"></a>
  <div class="nav">
    {{-- <img src="svg/menu.svg" class="menu-icon"> --}}
    <div class="menu-contents">
      @if(Auth::check())
        <p>{{ Auth::user()->name }}</p>
        <a class="" href="{{ route('post') }}">投稿する</a>
        <a class="" href="{{ route('favorite') }}">お気に入り</a>
        <a class="" href="{{ route('user/mypage') }}">MyPage</a>
        <a class="" href="{{ url('about') }}">OFLogについて</a>
        <a class="blue-link" href="{{ route('logout') }}">ログアウト</a>
      @else
        <div>
          <a class="" href="{{ url('/user/register') }}">新規登録</a>
          <a class="" href="{{ url('/user/login') }}">ログイン</a>
          <a class="" href="{{ url('about') }}">OFLogについて</a>
        </div>
      @endif
    </div>
  </div>
</header>
