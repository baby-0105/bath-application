@extends('app')
@section('content')
    <div class="mypage">
        <div class="user-info">
            <div class="basic">
                <div class="person">
                    <a class="user-icon" href=""><img src="{{ asset($icon_path) }}" alt="ユーザーアイコン"></a>
                    <p class="name">{{ auth()->user()->name }}</p>
                    <img class="key-img @if($user_info->is_release) hide @endif" src="{{ asset('svg/key-icon.svg') }}" alt="鍵マーク">
                </div>
                @if(isset($prefecture))
                    <p class="prefecture">
                        <img src="{{ asset('svg/location.svg') }}" alt="場所のアイコン">
                        <span>{{ $prefecture }}</span>
                    </p>
                @endif
            </div>
            @if(isset($user_info->introduce)) <p class="intro">{{ $user_info->introduce }}</p> @endif
        </div>
        <div class="link-area">
            <a class="btn" href="{{ route('user.edit') }}">ユーザー情報編集</a>
            <a class="btn" href="{{ route('post.mypost') }}">My投稿</a>
            <a class="btn" href="{{ route('user.favorite') }}">お気に入り</a>
        </div>
    </div>
@endsection
