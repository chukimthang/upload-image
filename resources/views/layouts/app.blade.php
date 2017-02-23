<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Upload Image</title>
    
    {!! Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
    {!! Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}
</head>
<body>
    <div id="wrapper">
        @yield('content')
    </div>
</body>
</html>
