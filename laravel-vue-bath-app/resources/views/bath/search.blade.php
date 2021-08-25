@extends('app')
@section('content')
    <div class="bath-search">
        <div class="search-container">
            <h2 class="title">お風呂を検索する</h2>
            <search v-bind:select-data="{{ $selectData }}"></search>
        </div>
    </div>
@endsection
