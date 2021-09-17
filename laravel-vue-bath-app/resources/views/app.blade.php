<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}">
        <title>OFLog ~あなたの風呂活に新たな彩を~</title>
    </head>

    <body>
        @include('layouts.components.header')
        <div class="main" id="app">
            <div class="sns-update-profile popup @if(session('snsUpdateProfile') && session('nonVerify'))flex @else hide @endif" id="popup">
                <div class="content">
                    <h3 class="title">※まだ、ユーザー登録が完了していません</h3>
                    <p class="text">ユーザー登録を完了させてください。</p>
                    <form method="POST" action="{{ route('update.profile') }}">
                        @csrf
                        <p class="status-error error"></p>
						<p class="timeout-error error"></p>
                        <p class="name-error error"></p>
                        <div class="list">
                            <label>ユーザー名</label>
                            <input class="input" type="text" name="name" value="{{ session('register.name') }}">
                        </div>
                        <p class="email-error error">
                        <div class="list">
                            <label>メールアドレス</label>
                            <input class="input" type="text" name="email" value="{{ session('register.email') }}">
                        </div>
                        <button class="btn submit" type="submit"></button>
                    </form>
                </div>
            </div>

            @include('layouts.components.popup_mail_confirm')

            @yield('content')
        </div>

        @include('layouts.components.footer')
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>