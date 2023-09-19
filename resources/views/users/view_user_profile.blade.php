<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layout.head-tags')
        <title> profile | {{ auth()->user()->name }} </title>
    </head>

    <body class="add-commodity-body">

        @include('layout.main-header')

        <div class="container-fluid px-0 pps-content">

            <div class="pps-aside">

                <aside class="pps-sidebar-icon">
                    <div class="d-flex flex-column flex-shrink-0 pps-sidebar__nav-icon">
                        <span class="d-block pps-sidebar-icon-title" title="Add Commodity item" data-bs-toggle="tooltip" data-bs-placement="right">
                            <span class="icon-container bi me-2">
                                <img class="icon" src="{{ asset('images/admin-dark.ico') }}" alt="">
                            </span>
                          <span class="visually-hidden">{{ auth()->user()->name }}</span>
                        </span>
                        <hr class="pps-sidebar-divider">
                    </div>
                </aside>

                <aside class="pps-sidebar wide-display collapse collapse-horizontal" id="collapseSideMenuBar">
                    <div class="form--header">
                        <img class="form--brand" src="{{ asset('images/admin-dark.ico') }}" alt="">
                        <h1 class="form--title">{{ auth()->user()->name }}</h1>
                    </div>
                </aside>

            </div>

            <main class="pps-main-content">

                <div class="add-commodity-form scrollable-list">


                    <div class="form--header">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <img class="form--brand" src="{{asset('images/admin-dark.ico') }}" alt="">
                        <h1 class="form--title">user profile</h1>
                    </div>

                    <div class="pps-commodities">
                                <div class="commodity">
                                    <div class="card">
                                        <header class="card__header">
                                            <div class="commodity__icon">
                                                <img class="icon" src="{{ asset('images/admin-dark.ico') }}" alt="">
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

                                            <div class="card__divider"></div>

                                        </footer>
                                    </div>
                                </div>

                        </div>

                    </div>

                    <div class="content-header">
                        <h3 class="title">The business you own</h3>
                    </div>

                    <div class="flex flex-col--wrap scrollable-list">
                        <div class="commodity">
                            <div class="card">
                                <header class="card__header">
                                    <div class="commodity__icon">

                                        <h3 class="commodity__name">{{  auth()->user()->businesses->name }}</h3>
                                    </div>
                                    <div class="commodity__tags">
                                        <span class="commodity__description">{{ auth()->user()->businesses->description }}</span>
                                    </div>
                                </header>

                                <div class="card__body">
                                    <span class="commodity__acquisition-date">
                                        <span class="acquisition-text">Registered On</span>

                                            <span class="badge acquisition-date">{{ date('d-m-Y', strtotime(auth()->user()->businesses->created_at)) }}</span>

                                    </span>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>

            </main>
        </div>

        @include('layout.main-footer')


        @include('layout.script-tags')

    </body>
</html>
