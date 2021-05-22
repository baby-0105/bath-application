@extends('layouts/app')

@section('content')
@isset($message)
	<div>{{$message}}</div>
@endisset

@empty($message)
<div class="register-confirm">
	<h2>※※本登録はまだ完了していません。</h2>
	<h1>本登録画面</h1>
	<br>
	<form method="POST" action="{{ route('user.registered') }}">
		@csrf
		<input id="email_verify_token" type="hidden" name="email_verify_token" value="{{ $email_verify_token }}">
		<div class="btnarea">
			<button class="btn green" type="submit">本登録を完了させる</button>
		</div>
	</form>
</div>
@endempty
@endsection
