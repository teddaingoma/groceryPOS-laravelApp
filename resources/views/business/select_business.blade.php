<!DOCTYPE html>
<html lang="en">
<head>

    <title>Welcome {{ auth()->user()->name }}</title>
    @include('layout.head-tags')

</head>
<body class="add-commodity-body select-page">

    <main class="form-signin login">

        <div class="pps-main-content-header">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <h1 class="login--title">Grocery POS System</h1>
        </div>

        <hr>

        <div class="pps-main-content-body">

            <div class="flex flex-col--wrap scrollable-list">

                <div class="commodity">
                    <div class="card">
                        <header class="card__header">
                        </header>
                        <div class="card__body">
                            <span class="commodity__quantity">
                                <span class="quantity-text">{{ auth()->user()->name }}, you dont have a registered business</span>

                            </span>
                            <span class="commodity__acquisition-date">
                                <span class="badge acquisition-date">
                                    Go to dashboard unregistered?
                                </span>
                            </span>
                        </div>
                        <div class="card__btn">
                            <a href="{{ route('home.index') }}" class="btn btn--primary btn--img">
                                <span class="btn__text">Dashboard >></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="commodity">
                    <div class="card">
                        <header class="card__header">
                            <div class="commodity__icon">
                                <h3 class="commodity__name">Register</h3>
                            </div>
                        </header>

                        <div class="card__body">
                            <span class="commodity__quantity">

                                <span class="commodity__unit">
                                    You can register a business you own
                                </span>
                            </span>

                        </div>
                        <div class="card__btn">
                            <a href="{{ route('register_business') }}" class="btn btn--primary btn--img">
                                <span class="btn__text">Register</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>

    <div class="container-fluid px-0 pps-content">


        <main class="pps-main-content">

            <div class="form--header">
                <span class="icon-container">
                    <img class="icon" src="../images/logo-light.ico" alt="">
                </span>
                <h1 class="form--title title-case-lower">Grocery POS System</h1>
            </div>

            <div class="form--header">
                <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                    Welcome, User!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>

            <div class="pps-main-content-header">
                <h2 class="pps-main-content-title title-case-lower">You do not have any registered business</h2>
            </div>

            <div class="pps-main-content-body">

                    <div class="commodity">

                      <div class="card dashboard">
                        <header class="card__header">
                            <div class="commodity__icon">
                                <img class="icon " src="../images/dashboard-dark.ico" alt="">
                                <h3 class="commodity__name">Dashboard</h3>
                            </div>
                            <div class="commodity__tags">
                                <span class="commodity__description">Go to your Dashboard unregistered</span>
                            </div>
                        </header>

                        <div class="card__btn">
                            <a href="../home.html" class="btn btn--primary btn--img">
                                <span class="btn__text">dashboard >></span>
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
                                <img class="icon " src="../images/register-dark.ico" alt="">
                                <h3 class="commodity__name">Register</h3>
                            </div>
                            <div class="commodity__tags">
                                <span class="commodity__description">Register a business you own</span>
                            </div>
                        </header>

                        <div class="card__btn">
                            <a href="rey.html" class="btn btn--primary btn--img">
                                <span class="btn__text">register >></span>
                            </a>
                        </div>

                        <footer class="card__footer">

                        </footer>

                      </div>

                    </div>
            </div>

        </main>

    </div>

    @include('layout.script-tags')

</body>
</html>
