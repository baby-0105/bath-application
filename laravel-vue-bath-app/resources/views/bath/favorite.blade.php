@extends('app')
@section('content')
    <div class="favorite">
        <favorited-bath v-bind:favorited="{{ $favoritedBaths }}"></favorited-bath>
        <p class="no-favorited hide @if($favoritedBaths->isEmpty()) show @endif">お気に入りのお風呂は存在しません。</p>
    </div>
@endsection
