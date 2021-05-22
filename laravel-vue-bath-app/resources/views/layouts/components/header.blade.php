<header class="header">
  <a href="{{ url('/') }}">Onsen</a>
  <div class="nav">
    <div>
      <button class="blue-link">ログアウト</button>
    </div>
    <div>
      <a href="{{ url('/user/register') }}">新規登録</a>
      <a href="{{ url('/user/login') }}">ログイン</a>
    </div>
  </div>
</header>

<style>
  .header{
    display: flex;
    justify-content: space-between;
  }
  .header .nav{
    display: flex;
  }
</style>
