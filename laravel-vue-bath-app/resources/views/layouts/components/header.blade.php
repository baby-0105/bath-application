<header class="header">
  <a href="{{ url('/') }}"><img class="logo" src="{{ url('svg/OFLog-translate.svg') }}" alt="ヘッダーのロゴ"></a>
  <div class="nav">
    {{-- <img src="svg/menu.svg" class="menu-icon"> --}}
    <div class="items">
      @if(Auth::check())
        <p>{{ Auth::user()->name }}</p>
        <a class="link" href="{{ url('post') }}">
          <span class="text">投稿する</span>
          <img class="nav-bg" src="{{ url('svg/square-light-blue.svg') }}" alt="navリンクの背景">
        </a>
        <a class="link" href="{{ url('favorite') }}">
          <span class="text">お気に入り</span>
          <img class="nav-bg" src="{{ url('svg/square-light-blue.svg') }}" alt="navリンクの背景">
        </a>
        <a class="link" href="{{ url('user/mypage') }}">
          <span class="text">MyPage</span>
          <img class="nav-bg" src="{{ url('svg/square-light-blue.svg') }}" alt="navリンクの背景">
        </a>
        <a class="link" href="{{ url('about') }}">
          <span class="text">OFLogについて</span>
          <img class="nav-bg" src="{{ url('svg/square-light-blue.svg') }}" alt="navリンクの背景">
        </a>
        <a class="link blue-link" href="{{ url('logout') }}">
          <span class="text">ログアウト</span>
          <img class="nav-bg" src="{{ url('svg/square-light-blue.svg') }}" alt="navリンクの背景">
        </a>
      @else
        <div>
          <a class="link" href="{{ url('/user/register') }}">
            <span class="text">新規登録</span>
            <img class="nav-bg" src="{{ url('svg/square-light-blue.svg') }}" alt="navリンクの背景">
          </a>
          <a class="link" href="{{ url('/user/login') }}">
            <span class="text">ログイン</span>
            <img class="nav-bg" src="{{ url('svg/square-blue.svg') }}" alt="navリンクの背景">
          </a>
          <a class="link" href="{{ url('about') }}">
            <span class="text">OFLogについて</span>
            <img class="nav-bg" src="{{ url('svg/square-light-blue.svg') }}" alt="navリンクの背景">
          </a>
        </div>
      @endif
    </div>
  </div>
</header>
