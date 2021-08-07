<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
        <title>OFLog ~あなたの風呂活に新たな彩を~</title>
    </head>

    <body>
        @include('layouts.components.header')
        <div class="main">
            <div class="popup @if(session('is_auth') || session('nonVerify'))flex @else hide @endif" id="popup">
                <div class="content">
                    <h3 class="title">※まだ、ユーザー登録が完了していません</h3>
                    <p class="text">ユーザー登録を完了させてください。</p>
                    <form method="POST" action="{{ route('update.profile') }}">
                        @csrf
                        @error('name') <p class="error">{{ $message }}</p> @enderror
                        <div class="list">
                            <label>ユーザー名</label>
                            <input class="input" type="text" name="name" value="{{ old('name') }}">
                        </div>
                        @error('email') <p class="error">{{ $message }}</p> @enderror
                        <div class="list">
                            <label>メールアドレス</label>
                            <input class="input" type="text" name="email" value="{{ old('email') }}">
                        </div>
                        <input class="btn" type="submit" value="登録する">
                    </form>
                </div>
            </div>
            @yield('content')
        </div>

        @include('layouts.components.footer')
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>