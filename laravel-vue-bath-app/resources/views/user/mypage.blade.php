@extends('app')
@section('content')
    <div class="popup @if(session('message')) flex @else hide @endif" id="popup">
        <div class="content">
            <p class="text">{{ session('message') }}</p>
            <button class="btn close" id="close"></button>
        </div>
    </div>
    <div class="mypage">
        <div class="user-info">
            <div class="basic">
                <div class="person">
                    <a class="user-icon" href=""><img class="user-icon-img" src="@if(isset($user_info->icon_path)) {{ asset(Storage::url($icon_path)) }} @else {{ asset('svg/bath-mark-light-blue.svg') }} @endif" alt="ユーザーアイコン"></a>
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
            <a class="btn" href="{{ route('user.edit.show') }}">ユーザー情報編集</a>
            <a class="btn" href="{{ route('post.mypost') }}">My投稿</a>
            <a class="btn" href="{{ route('bath.favorite.index') }}">お気に入り</a>
        </div>
    </div>
@endsection
