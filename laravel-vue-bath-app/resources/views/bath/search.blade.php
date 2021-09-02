@extends('app')
@section('content')
    <div class="bath-search" id="bathSearch">
        <div class="search-container">
            <h2 class="main-title">お風呂を検索する</h2>
            <search v-bind:select-data="{{ $selectData }}"></search>
        </div>
    </div>
@endsection
