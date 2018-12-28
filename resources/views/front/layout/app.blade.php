<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    {{-- <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> --}}
     <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
    <script>
        $(window).load(function() {
            $(".se-pre-con").fadeOut(4000);
        });
    </script>
    @yield('add_js')
</body>
</html>