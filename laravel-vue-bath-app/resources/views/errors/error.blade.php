<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
        <title>OFLog ~あなたの風呂活に新たな彩を~</title>
    </head>
    <style>
        .error-page {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 1.5rem;
        }
        .error-page  .logo {
            margin-bottom: 20px
        }
    </style>
    <body>
        @include('layouts.components.header')
        <div class="main">
            <div class="content error-page">
                <div class="logo">
                    <a href="{{ route('top') }}"><img src="{{ asset('img/OFLog-logo.png') }}"></a>
                </div>
                <div class="message">
                    @yield('message')
                </div>
            </div>
        </div>
        @include('layouts.components.footer')
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
