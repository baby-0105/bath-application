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
                        <button class="btn dlt"　type="submit"></button>
                    </form>
                    <button class="btn close" id="close"></button>
                </div>
            </div>
        </div>
        <div class="title-block">
            <h2 class="title">My投稿一覧</h2>
            <img class="key-img @if(auth()->user()->user_info->is_release) hide @endif" src="{{ asset('svg/key-icon.svg') }}" alt="鍵マーク">
        </div>
        <div class="index">
            <select-order :posts="{{ $posts }}"></select-order>
        </div>
    </div>
@endsection
