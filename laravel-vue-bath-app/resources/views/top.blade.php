@extends('layouts.app')
@section('content')
<div id="toppage">
  <p>さぁ、今日のお風呂を探そう！</p>
  <h1>Onsen</h1>
  <form action="">
    @csrf
    <select name="prefecture">
      <option selected>選択してください</option>
      <option>大阪</option>
      <option>東京</option>
    </select>
    <input type="search" placeholder="キーワードを入力してください">
    <input type="submit" value="検索する">
  </form>
</div>
@endsection
