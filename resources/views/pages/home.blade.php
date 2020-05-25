@extends('layout')

@section('content')
    <div class="home-page__container">
        <div class="ui grid centered aligned">
            <div class="ten wide column centered aligned">
                <h1>Welcome to Education test system!</h1>
                <h3>You logged in as a member of "{{ $organization->name }}".</h3>
                <p>Explore your tests on <a href="/tests">My tests</a> page.</p>
                <p>Check your results on <a href="/results">Results</a> page.</p>
            </div>
        </div>
    </div>
@endsection