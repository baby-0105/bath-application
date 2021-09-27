@extends('app')
@section('content')
    <div class="popup @if(session('message')) flex @else hide @endif" id="popup">
        <div class="content">
            <p class="text">{{ session('message') }}</p>
            <button class="btn close" id="close"></button>
        </div>
    </div>
    <div id="toppage" class="top-page">
        <div class="top-container">
            <div class="first-view">
                <div class="title-block">
                    <p class="main-text">さぁ、今日のお風呂を探そう！</p>
                    <img class="logo" src="{{ asset('img/OFLog-logo.png') }}" alt="TOPページのロゴ">
                </div>
                <div class="btn-block">
                    <div class="search-btn-area">
                        <a class="search-btn" href="{{ route('bath.search') }}">
                            <span class="btn-name">検索する</span>
                            <img class="bath-mark" src="{{ asset('svg/bath-mark-light-blue.svg') }}" alt="温泉マークのボタン">
                        </a>
                    </div>
                    <div class="my-post-block">
                        <a class="search-btn" href="{{ route('post.mypost') }}">
                            <span class="btn-name">My投稿</span>
                            <img class="bath-mark" src="{{ asset('svg/bath-mark-light-blue.svg') }}" alt="温泉マークのボタン">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
