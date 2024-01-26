<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layout.head-tags')
        <title> profile | {{ auth()->user()->name }} </title>
    </head>

    <body class="add-commodity-body user-profile-page">

        @include('layout.main-header')

        <div class="form--header">
            <span class="icon-container">
                <img class="icon" src="{{ ('/images/admin-dark.ico') }}" alt="">
            </span>
            <h1 class="form--title title-case-lower">user profile</h1>
        </div>

        <div class="container-fluid px-0 pps-content">

            <main class="pps-main-content width-content-center">

                <div class="pps-main-content-header">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <span class="icon-container icon--circle">
                        <img class="icon" src="../images/profile-dark.ico" alt="">
                    </span>
                    <h2 class="pps-main-content-title title-case-lower">user profile</h2>
                </div>

                <div class="pps-main-content-body">

                    <div class="commodity">

                        <div class="card    ">
                            <header class="card__header">
                                <div class="commodity__icon">
                                    <img class="icon" src="{{ asset('images/admin-light.ico') }}" alt="">
                                    <h3 class="commodity__name">{{ auth()->user()->name  }}</h3>
                                </div>
                                <div class="commodity__tags">
                                    <span class="commodity__description">{{ auth()->user()->email }}</span>
                                </div>
                            </header>

                            <div class="card__body">

                                <span class="commodity__acquisition-date">
                                    <span class="acquisition-text">Registered on</span>

                                        <span class="badge acquisition-date">{{ date('d-m-Y', strtotime(auth()->user()->created_at) ) }}</span>

                                </span>

                                <span class="commodity__quantity">
                                    <span class="quantity-text">username</span>
                                    <span class="commodity__unit">
                                        {{ auth()->user()->username }}
                                    </span>
                                </span>
                                <div class="btn--group">
                                    <a href="{{ route('edit_user') }}" class="btn btn--edit btn--icon">
                                        <span class="icon-container icon--small">
                                            <img class="icon" src="{{ URL("images/edit-filled.ico") }}" alt="">
                                        </span>
                                        <span class="btn__text">edit profile</span>
                                    </a>

                                </div>

                            </div>

                            <footer class="card__footer">

                                @if (auth()->user()->businesses !== null)

                                    <div class="card card--secondary">
                                        <header class="card__header">
                                            <div class="commodity__icon">
                                                <h3 class="commodity__name">Business Owned</h3>
                                            </div>
                                            <div class="commodity__tags">
                                                <span class="commodity__description"> <strong> {{  auth()->user()->businesses->name }} | </strong> {{ auth()->user()->businesses->description }}</span>
                                            </div>
                                        </header>

                                        <div class="card__body">

                                            <span class="commodity__acquisition-date">
                                                <span class="acquisition-text">Registered on</span>

                                                    <span class="badge acquisition-date">{{ date('d-m-Y', strtotime(auth()->user()->businesses->created_at)) }}</span>

                                            </span>
                                        </div>

                                    </div>

                                @endif

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
