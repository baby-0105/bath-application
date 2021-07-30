<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
  <title>OFLog ~あなたの風呂活に新たな彩を~</title>
</head>

@include('layouts.components.header')
<body>
    @if (session('flash_message'))
      <div class="flash_message">
        {{ session('flash_message') }}
      </div>
    @endif
    @yield('content')
    <script src="{{ mix('js/app.js') }}"></script>
</body>
@include('layouts.components.footer')
</html>