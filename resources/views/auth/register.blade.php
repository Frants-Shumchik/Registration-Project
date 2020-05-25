@extends('layouts.auth')

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui white header">
            <div class="content">
                Education Test System
            </div>
        </h2>
        <form method="POST" action="{{ route('register') }}" class="ui huge form">
            @csrf
            <div class="ui stacked segment left aligned">
                <div class="field{{ $errors->has('personalCode') ? ' error' : '' }}">
                    <label>Organization personal code</label>
                    <input type="text" name="personalCode" value="{{ old('personalCode') }}" required>
                </div>
                <div class="field{{ $errors->has('firstName') ? ' error' : '' }}">
                    <label>First name</label>
                    <input type="text" name="firstName" value="{{ old('firstName') }}" required>
                </div>
                <div class="field{{ $errors->has('lastName') ? ' error' : '' }}">
                    <label>Last name</label>
                    <input type="text" name="lastName" value="{{ old('lastName') }}" required>
                </div>
                <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="field">
                    <label>Password confirmation</label>
                    <input type="password" name="password_confirmation" required>
                </div>
                <button type="submit" class="ui fluid large teal submit button">Register</button>
            </div>
        </form>
        <div class="ui message">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</div>
@endsection
