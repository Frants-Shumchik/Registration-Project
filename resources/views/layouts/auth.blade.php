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
                background-color: #1b1c1c;
            }
            body > .grid {
                height: 100%;
            }
            .column {
                max-width: 450px;
            }
            .white {
                color: #fff !important;
            }
        </style>
    </head>
    <body>
        @yield('content')
    </body>
</html>