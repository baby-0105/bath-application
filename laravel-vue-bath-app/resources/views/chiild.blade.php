@extends('layouts.app')

@section('content')
  <section>
    <h2>以下はVueコンポーネントです</h2>
    <foo-bar
      :prop-sample-price='@json($sample->price)'>
    </foo-bar>
  </section>
@endsection