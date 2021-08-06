@extends('app')
@section('content')
    <form action="" class="search-form">
        @csrf
        <select name="prefecture">
            <option selected>選択してください</option>
            <option>大阪</option>
            <option>東京</option>
        </select>
        <input type="search" placeholder="キーワードを入力してください">
        <input type="submit" value="検索する">
    </form>
@endsection
