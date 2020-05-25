@extends('layout')

@section('content')
    <h1 class="ui header">Your answers was sent to the server!</h1>
    <h2>Your result: {{ $correctCount }}/{{ $totalCount }}.</h2>
    <h2>You can check the result <a href="{{ url('results') }}">here</a>.</h2>
@endsection