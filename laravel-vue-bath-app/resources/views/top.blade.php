@extends('layouts.app')
@section('content')
    <div id="toppage" class="top-page">
        <div class="container">
            <div class="first-view">
                <div class="search-btn-area">
                    <a href="{{ url('post/search') }}">検索する</a>
                </div>
                <div class="title-block">
                    <p class="main-text">さぁ、今日のお風呂を探そう！</p>
                    <img class="logo" src="{{ url('img/OFLog-logo.png') }}" alt="TOPページのロゴ">
                </div>
                <div class="my-post-block">
                    <a href="{{ url('post/mypost') }}">My投稿</a>
                </div>
                <button id="test_jquery">ぽちっとな</button>
            </div>

            <div class="recommendation">
                <div class="tab-area">
                    @if(Auth::check())
                        <a href="">お住まいの都道府県で人気のお風呂</a>
                        <a href="">お住まいの地方で人気のお風呂</a>
                    @endif
                    <a href="">人気のお風呂</a>
                </div>
                {{-- TODO: コンポーネント作っても良さそう --}}
                @if(Auth::check())
                    <div class="my-pref">お住まいの都道府県で人気のお風呂一覧</div>
                    <div class="my-region">お住まいの地方で人気のお風呂一覧</div>
                @endif
                <div class="popular">人気のお風呂一覧</div>
            </div>
        </div>
    </div>
@endsection
