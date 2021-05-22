@extends('layouts/app')

@section('content')
@isset($message)
	<div>{{$message}}</div>
@endisset

@empty($message)
<div class="register-confirm">
	<h2>本登録が完了しました。</h2>
	<p>引き続きOFLogをご利用ください</p>
</div>
@endempty
@endsection
