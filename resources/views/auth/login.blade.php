@extends('layouts.auth')

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui white header">
            <div class="content">
                Education Test System
            </div>
        </h2>
        <form method="POST" action="{{ route('login') }}" class="ui large form">
            @csrf
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" placeholder="E-mail address">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>
                <button type="submit" class="ui fluid large teal submit button">Login</button>
            </div>
        </form>
        @if ($errors->has('email'))
            <div class="ui error message">
                <strong>{{ $errors->first('email') }}</strong>
            </div>
        @elseif ($errors->has('password'))
            <div class="ui error message">
                <strong>{{ $errors->first('password') }}</strong>
            </div>
        @endif
        <div class="ui message">
            New to us? <a href="{{ route('register') }}">Register</a>
        </div>
    </div>
</div>
@endsection


