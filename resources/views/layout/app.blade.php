<!DOCTYPE html>
<html lang="en">
<head>
    <title>Grocery POS system - Welcome @auth {{ auth()->user()->name }} @endauth</title>
    @include('layout.head-tags')
</head>
<body>
    @include('layout.main-header')

    @include('layout.menu-bar-toggler')

    <div class="container-fluid px-0 pps-content">
        <div class="pps-aside">
            @include('layout.main-sidebar')
            @include('layout.main-sidebar-wide')
            @include('layout.main-icon-sidebar')
        </div>

        <main class="pps-main-content">
            @yield('content')
        </main>
    </div>

    @include('layout.main-footer')


    @include('layout.script-tags')

</body>
</html>
