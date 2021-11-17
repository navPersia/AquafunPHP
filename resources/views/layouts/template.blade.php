<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @include('shared.icons')
    <title>@yield('title', 'AquaFun')</title>
</head>
<body>
@include('shared.navigation')

<main class="container mt-3">
    @yield('main', 'Page under construction ...')
</main>

@include('shared.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
