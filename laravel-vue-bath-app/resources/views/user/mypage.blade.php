@extends('app')
@section('content')
    <div class="mypage">
        <div class="user-info">
            <div class="basic">
                <div class="person">
                    <a class="user-icon" href=""><img src="{{ url('svg/bath-mark-light-blue.svg') }}" alt="ユーザーアイコン"></a>
                    <p class="name">馬場翔矢</p>
                </div>
                <p class="prefecture">
                    <img src="{{ url('svg/location.svg') }}" alt="場所のアイコン">
                    <span>大阪府</span>
                </p>
            </div>
            <p class="intro">
                よろしくお願いします。よろしくお願いします。よろしくお願いします。よろしくお願いします。よろしくお願いします。
                よろしくお願いします。よろしくお願いします。よろしくお願いします。よろしくお願いします。よろしくお願いします。
                よろしくお願いします。よろしくお願いします。よろしくお願いします。よろしくお願いします。よろしくお願いします。
            </p>
        </div>
        <div class="link-area">
            <a href="{{ route('user.edit') }}">ユーザー情報編集</a>
            <a href="{{ route('post.mypost') }}">My投稿</a>
            <a href="{{ route('user.favorite') }}">お気に入り</a>
        </div>
    </div>
@endsection
