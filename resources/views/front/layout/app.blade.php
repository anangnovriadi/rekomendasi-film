<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <title>Rekomendasi Film - @yield('title')</title>
</head>
<body>
    <div>
        @include('front.layout.header')
        <div>
            @yield('content')
        </div>
        @include('front.layout.footer')
    </div>
</body>
</html>