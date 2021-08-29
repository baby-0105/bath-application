@extends('app')
@section('content')

    <div class="post-index" id="myPost">
        <div class="popup-delete popup hide" id="popup">
            <div class="content">
                <p class="text">こちらの投稿を削除しますか？</p>
                <div class="btn-area">
                    <form method="POST" action="{{ route('post.mypost.delete') }}">
                        @csrf
                        <input id="postId" type="hidden" name="postId" value="">
                        <button type="submit" class="btn dlt">削除</button>
                    </form>
                    <button class="btn close" id="close">閉じる</button>
                </div>
            </div>
        </div>
        <div class="title-block">
            <h2 class="title">My投稿一覧</h2>
            <img class="key-img @if(auth()->user()->user_info->is_release) hide @endif" src="{{ asset('svg/key-icon.svg') }}" alt="鍵マーク">
        </div>
        <div class="index">
            <select-order></select-order>
            <ul class="bath first-view">
                @foreach ($posts as $post)
                    <li class="list">
                        <input class="post-id" type="hidden" value="{{ $post->id }}">
                        <a class="dlt-post"><img class="dlt-post-img" src="{{ asset('svg/dlt-icon.svg') }}" alt="投稿削除ボタン"></a>
                        <h4 class="title">- {{ $post->title }} -</h4>
                        <div class="desc">
                            <div class="info">
                                <div class="bath-img">
                                    <img class="main-img" src="@if($post->main_image_path) {{ asset(Storage::url($post->main_image_path) . '?' . $post->updated_at->format('YmdHis')) }} @else {{ asset('svg/bath-mark-light-blue.svg') }} @endif" alt="風呂の画像">
                                    @if($post->sub_picture1_path || $post->sub_picture2_path || $post->sub_picture3_path)
                                        <div class="sub-imgs">
                                            @if($post->sub_picture1_path)
                                                <img class="sub-img" src="{{ asset(Storage::url($post->sub_picture1_path) . '?' . $post->updated_at->format('YmdHis')) }}" alt="風呂のサブ画像">
                                            @endif
                                            @if($post->sub_picture2_path)
                                                <img class="sub-img" src="{{ asset(Storage::url($post->sub_picture2_path) . '?' . $post->updated_at->format('YmdHis')) }}" alt="風呂のサブ画像">
                                            @endif
                                            @if($post->sub_picture3_path)
                                                <img class="sub-img" src="{{ asset(Storage::url($post->sub_picture3_path) . '?' . $post->updated_at->format('YmdHis')) }}" alt="風呂のサブ画像">
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="review">
                                @if($post->thoughts) <p class="thoughts"> {{ $post->thoughts }} </p> @endif
                                <ul class="review-num">
                                    <li>{{ $post->eval_cd }}</li>
                                    <li>@if($post->hot_water_eval_cd) {{ $post->hot_water_eval_cd }} @else  -- @endif</li>
                                    <li>@if($post->rock_eval_cd) {{ $post->rock_eval_cd }} @else  -- @endif</li>
                                    <li>@if($post->sauna_eval_cd) {{ $post->sauna_eval_cd }} @else  -- @endif</li>
                                </ul>
                            </div>
                        </div>
                        <p class="post-time">{{ $post->updated_at->format("Y/m/d H:i:s") }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
