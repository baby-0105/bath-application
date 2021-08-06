<header class="header" id="header">
  <div class="container">
    <a href="{{ url('/') }}"><img class="logo" src="{{ url('img/OFLog-logo.png') }}" alt="ヘッダーのロゴ"></a>
    <div class="nav" id="nav">
      @if(Auth::check())
        <p>{{ Auth::user()->name }}</p>
        <a class="link" href="{{ route('post.submit') }}">
          <span class="text">投稿する</span>
          <img class="nav-bg" src="{{ url('svg/square-light-blue.svg') }}" alt="navリンクの背景">
        </a>
        <a class="link" href="{{ route('user.favorite') }}">
          <span class="text">お気に入り</span>
          <img class="nav-bg" src="{{ url('svg/square-blue.svg') }}" alt="navリンクの背景">
        </a>
        <a class="link" href="{{ route('user.mypage') }}">
          <span class="text">MyPage</span>
          <img class="nav-bg" src="{{ url('svg/square-light-blue.svg') }}" alt="navリンクの背景">
        </a>
        <a class="link blue-link" href="{{ url('logout') }}">
          <span class="text">ログアウト</span>
          <img class="nav-bg" src="{{ url('svg/square-blue.svg') }}" alt="navリンクの背景">
        </a>
      @else
        <a class="link" href="{{ route('user.register') }}">
          <span class="text">新規登録</span>
          <img class="nav-bg" src="{{ url('svg/square-light-blue.svg') }}" alt="navリンクの背景">
        </a>
        <a class="link" href="{{ route('user.login') }}">
          <span class="text">ログイン</span>
          <img class="nav-bg" src="{{ url('svg/square-blue.svg') }}" alt="navリンクの背景">
        </a>
      @endif
    </div>
  </div>
</header>
