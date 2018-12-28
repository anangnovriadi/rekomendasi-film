<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    @yield('add_css')
    <title>Rekomendasi Film - @yield('title')</title>
</head>
<body>
    <div class="se-pre-con"></div>
    <div>
        @include('front.layout.header2')
        <div>
            @yield('content')
        </div>
        @include('front.layout.footer')
    </div>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
    <script src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://use.fontawesome.com/releases/v5.0.9/js/all.js"></script>
    <script>
        $(window).load(function() {
            $(".se-pre-con").fadeOut(2000);
        });
    </script>
    @yield('add_js')
</body>
</html>