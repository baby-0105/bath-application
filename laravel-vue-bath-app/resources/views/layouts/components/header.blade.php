<header class="header" id="header">
  <div class="container">
    <a href="{{ route('top') }}"><img class="logo" src="{{ asset('img/OFLog-logo.png') }}" alt="ヘッダーのロゴ"></a>
    <a class="burger" id="burger"><img class="burger-icon" src="{{ asset('svg/burger-menu.svg') }}" alt="ハンバーガーメニュー"></a>
  </div>
  <div class="nav" id="nav">
    <div class="nav-container">
      @if(Auth::check())
        {{-- <p>{{ Auth::user()->name }}</p> --}}
        <a class="link" href="{{ route('post.mypost') }}"> My投稿 </a>
        <a class="link" href="{{ route('post.topost') }}"> 投稿する </a>
        <a class="link" href="{{ route('bath.search') }}"> 検索する </a>
        <a class="link" href="{{ route('bath.favorite.index') }}"> お気に入り </a>
        <a class="link" href="{{ route('user.mypage') }}"> MyPage </a>
        <a class="link blue-link" href="{{ route('logout') }}"> ログアウト </a>
      @else
        <a class="link register-link" href="{{ route('user.register') }}"> 新規登録 </a>
        <a class="link login-link" href="{{ route('user.login') }}"> ログイン </a>
      @endif
      <img class="batsu-icon" id="closeNav" src="{{ asset('svg/batsu.svg') }}" alt="バツ　アイコン">
    </div>
  </div>
</header>
