<h1>データ取得チェックページ</h1>

<form method="POST" action="{{ route('check_scraping.getUrl') }}">
    @csrf
    <button>おす</button>
</form>
