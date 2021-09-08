@extends('app')
@section('content')
    <div class="user-form change-email">
        <h2 class="title">メールアドレス変更</h2>
        <form class="form" method="POST" action="{{ route('user.change_email.sendEmail') }}">
            @csrf
            @error('new_email') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label class="field-name">新しいメールアドレス</label>
                <input class="field" type="text" name="new_email" value="">
            </div>
            <button class="btn main-submit-btn" type="submit"></button>
        </form>
        <div class="other-links">
            <a href="{{ route('user.edit.show') }}" class="link">ユーザー情報を変更する</a>
            <a href="{{ route('user.change_password.show') }}" class="link @if(isset(auth()->user()->sns_id)) hide @endif">パスワードを変更する</a>
        </div>
    </div>
@endsection
