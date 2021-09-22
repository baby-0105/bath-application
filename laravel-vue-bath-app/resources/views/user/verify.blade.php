@extends('app')
@section('content')
@isset($message)
	<div class="register-confirm">
		<p class="text">{{$message}}</p>
	</div>
@endisset
@empty($message)
	<div class="register-confirm">
		<h2 class="title">本登録が完了しました。</h2>
		<p class="text">引き続きOFLogをご利用ください</p>
	</div>
@endempty
@endsection
