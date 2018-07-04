<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/src/libs/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('public/src/css/app.css') . '?ver=' . filemtime(public_path('src/css/app.css')) }}">
</head>
<body>
    @include('includes.header')
    <div class="container">
        @yield('content')
    </div>

    @include('includes.modal')

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="{{ URL::to('public/src/libs/bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js') }}"></script>
    
    <script src="{{ URL::to('public/src/js/app.js') . '?ver=' . filemtime(public_path('src/js/app.js')) }}"></script>
</body>
</html>
