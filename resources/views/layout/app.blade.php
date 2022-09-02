<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Grocery Portable Point-Of-Sales system for small-scale grocery businesses">
    <meta name="author" content="teddai Ngoma">
    <title>Grocery POS system - Welcome</title>
    <meta name="description" content="Portable POS system">
    <meta property="og:title" content="Portable POS system">
    <meta property="og:description" content="Portable POS system">
    <meta property="og:type" content="website">
    <meta property="og:image" content="http://">
    <meta property="og:url" content="https://pps.com">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


    <!-- HypeGames icon -->
    <link rel="icon" href="{{ asset('images/logo-dark.ico') }}">
</head>
<body>
    @include('layout.main-header')

    <div class="container-fluid px-0 pps-content">
        <div class="pps-aside">
            @include('layout.main-sidebar')
            @include('layout.main-icon-sidebar')
        </div>

        <main class="pps-main-content">
          @include('pages.show')
        </main>
    </div>

    @include('layout.main-footer')


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
