<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title>Fixed Menu Example - Semantic</title>
        <link rel="stylesheet" type="text/css" href="{{ url('css/semantic.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
        <style type="text/css">
            body {
                background-color: #FFFFFF;
            }
            .app {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
            }
            .content {
                flex: 1;
            }
            .ui.menu {
                margin-top: 0;
            }
            .ui.main.container {
                margin-top: 2em;
            }
            .ui.footer.segment {
                margin: 5em 0em 0em;
            }
        </style>
    </head>
    <body>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="{{ url('js/semantic.min.js') }}"></script>
        <div class="app">
            <div class="ui inverted menu">
                <div class="ui container">
                    <a href="/" class="header item">
                        Education Test System
                    </a>
                    @if ($user->role->name === 'Admin')
                        <a href="{{ url('tests') }}" class="item">Tests</a>
                        <a href="{{ url('results') }}" class="item">Results</a>
                    @else
                        <a href="{{ url('tests') }}" class="item">My Tests</a>
                        <a href="{{ url('results') }}" class="item">Results</a>
                    @endif
                   
                    <div class="right menu">
                        <a class="ui inverted item">
                            {{ $user->firstName }} {{ $user->lastName }} 
                        </a>
                        <a class="ui inverted item" href="{{ url('/logout') }}">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
            <div class="ui container content">
                @yield('content')
            </div>
            <div class="ui inverted vertical footer segment">
                <div class="ui center aligned container">
                    <div class="ui horizontal inverted small divided link list">
                        <a class="item" href="#">Site Map</a>
                        <a class="item" href="#">Contact Us</a>
                        <a class="item" href="#">Terms and Conditions</a>
                        <a class="item" href="#">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>