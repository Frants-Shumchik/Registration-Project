@extends('layout')

@section('content')
    <h1 class="ui header">Available tests list</h1>
    <div class="ui cards">
        @foreach($tests as $test)
            <div class="ui card">
                <div class="content">
                    <div class="header">{{ $test->name }}</div>
                    <div class="description">
                        <p><b>Questions count:</b> {{ $test->questions_count }}</p>
                        <p>
                            <b>Time available:</b>
                            @if ($test->available_time)
                                {{ (int) ($test->available_time / 60) }} mins
                                {{ number_format($test->available_time % 60) }} sec
                            @else
                                Unlimited
                            @endif
                        </p>
                        <p>{{ $test->description }}</p>
                    </div>
                </div>
                <div class="content">
                    <a href="/tests/{{ $test->id }}">
                    <button class="ui right labeled icon button">
                        <i class="right arrow icon"></i>
                        Start
                    </button>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection