<!DOCTYPE html>
<html lang="en">
<head>

    <title>Welcome {{ auth()->user()->name }}</title>
    @include('layout.head-tags')

</head>
<body class="add-commodity-body select-page">

    @include('layout.secondary-header')

    <div class="container-fluid px-0 pps-content">


        <main class="pps-main-content">

            <div class="form--header">
                <span class="icon-container">
                    <img class="icon" src="{{ asset('images/logo-light.ico') }}" alt="">
                </span>
                <h1 class="form--title title-case-lower">Grocery POS System</h1>
            </div>

            @if (session('status'))
                <div class="form--header">
                    <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="pps-main-content-header">
                <h2 class="pps-main-content-title title-case-lower">You do not have any registered business</h2>
            </div>

            <div class="pps-main-content-body">

                    <div class="commodity">

                      <div class="card dashboard">
                        <header class="card__header">
                            <div class="commodity__icon">
                                <img class="icon " src="{{ asset('images/dashboard-dark.ico') }}" alt="">
                                <h3 class="commodity__name">Dashboard</h3>
                            </div>
                            <div class="commodity__tags">
                                <span class="commodity__description">{{ auth()->user()->name }}, go to your Dashboard unregistered</span>
                            </div>
                        </header>

                        <div class="card__btn">
                            <a href="{{ route('home.index') }}" class="btn btn--primary btn--img">
                                <span class="btn__text">Dashboard >></span>
                            </a>
                        </div>

                        <footer class="card__footer">

                        </footer>

                      </div>

                    </div>

                    <div class="commodity">

                      <div class="card register">
                        <header class="card__header">
                            <div class="commodity__icon">
                                <img class="icon " src="{{ asset('images/register-dark.ico') }}" alt="">
                                <h3 class="commodity__name">Register</h3>
                            </div>
                            <div class="commodity__tags">
                                <span class="commodity__description">Register a business you own</span>
                            </div>
                        </header>

                        <div class="card__btn">
                            <a href="{{ route('register_business') }}" class="btn btn--primary btn--img">
                                <span class="btn__text">Register >></span>
                            </a>
                        </div>

                        <footer class="card__footer">

                        </footer>

                      </div>

                    </div>
            </div>

        </main>

    </div>

    @include('layout.secondary-footer')

    @include('layout.script-tags')

</body>
</html>
