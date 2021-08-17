@extends('app')
@section('content')
    <div class="popup @if(session('is_auth')) flex @else hide @endif" id="popup">
        <div class="content">
            <p class="text">{{ session('is_auth') }}</p>
            <button class="close" id="close">閉じる</button>
        </div>
    </div>
    <div class="popup @if(session('message')) flex @else hide @endif" id="popup">
        <div class="content">
            <p class="text">{{ session('message') }}</p>
            <button class="close" id="close">閉じる</button>
        </div>
    </div>
    <div id="toppage" class="top-page">
        <div class="top-container">
            <div class="first-view">
                <div class="search-btn-area">
                    <a class="search-btn" href="{{ route('post.search') }}">
                        <span class="btn-name">検索する</span>
                        <img class="bath-mark" src="{{ asset('svg/bath-mark-light-blue.svg') }}" alt="温泉マークのボタン">
                    </a>
                </div>
                <div class="title-block">
                    <p class="main-text">さぁ、今日のお風呂を探そう！</p>
                    <img class="logo" src="{{ asset('img/OFLog-logo.png') }}" alt="TOPページのロゴ">
                </div>
                <div class="my-post-block">
                    <a class="search-btn" href="{{ route('post.mypost') }}">
                        <span class="btn-name">My投稿</span>
                        <img class="bath-mark" src="{{ asset('svg/bath-mark-light-blue.svg') }}" alt="温泉マークのボタン">
                    </a>
                </div>
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
                <div class="popular">
                    <h3 class="title">人気のお風呂一覧</h3>
                    <ul class="bath">
                        <li class="list">
                            <h4 class="title">- 喜多の湯 -</h4>
                            <div class="desc">
                                <img class="bath-img" src="{{ asset('svg/bath-mark-light-blue.svg') }}" alt="風呂の画像">
                                <div class="review">
                                    <div class="review-num">
                                        <p class="whole-review">3.5</p>
                                        <ul class="others-review">
                                            <li>3</li>
                                            <li>3</li>
                                            <li>3</li>
                                            <li>3</li>
                                        </ul>
                                    </div>
                                    <p class="prefecture">大阪府八尾市</p>
                                </div>
                            </div>
                        </li>
                        <li class="list">
                            <h4 class="title">- 喜多の湯 -</h4>
                            <div class="desc">
                                <img class="bath-img" src="{{ asset('svg/bath-mark-light-blue.svg') }}" alt="風呂の画像">
                                <div class="review">
                                    <div class="review-num">
                                        <p class="whole-review">3.5</p>
                                        <ul class="others-review">
                                            <li>3</li>
                                            <li>3</li>
                                            <li>3</li>
                                            <li>3</li>
                                        </ul>
                                    </div>
                                    <p class="prefecture">大阪府八尾市</p>
                                </div>
                            </div>
                        </li>
                        <li class="list">
                            <h4 class="title">- 喜多の湯 -</h4>
                            <div class="desc">
                                <img class="bath-img" src="{{ asset('svg/bath-mark-light-blue.svg') }}" alt="風呂の画像">
                                <div class="review">
                                    <div class="review-num">
                                        <p class="whole-review">3.5</p>
                                        <ul class="others-review">
                                            <li>3</li>
                                            <li>3</li>
                                            <li>3</li>
                                            <li>3</li>
                                        </ul>
                                    </div>
                                    <p class="prefecture">大阪府八尾市</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
