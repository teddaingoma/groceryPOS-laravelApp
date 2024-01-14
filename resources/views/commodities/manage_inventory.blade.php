<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            Manage Inventory |
            @if( auth()->user()->businesses !== null )
                {{ auth()->user()->businesses->name }}
            @else
                unregistered business
            @endif
        </title>
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

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="pps-main-content-header">
                    <span class="icon-container icon--circle">
                        <img class="icon" src="{{ asset('images/item-dark.ico') }}" alt="">
                    </span>
                    <h2 class="pps-main-content-title title-case-lower">

                        Manage Invetories and Commodity Items

                        @if( auth()->user()->businesses !== null )
                            | {{ auth()->user()->businesses->name }}
                        @else
                            unregistered business
                        @endif

                    </h2>
                </div>

                <div class="pps-main-content-body">

                    <nav class="pps-body-nav">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Commodities</button>
                            <button class="nav-link" id="nav-category-tab" data-bs-toggle="tab" data-bs-target="#nav-category" type="button" role="tab" aria-controls="nav-category" aria-selected="true">Category</button>

                        </div>
                    </nav>

                    <div class="tab-content pps-body-content" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                            <div class="pps-commodities">

                                <div class="flex flex-col--wrap">



                                    @if( auth()->user()->businesses()->count() )
                                        @forelse ($user_commodities as $commodity)
                                            @if ($commodity->business_id == auth()->user()->businesses->id)
                                                <x-commodity :commodity="$commodity" />
                                            @endif
                                        @empty
                                            <div class="commodity">
                                                <p> {{ auth()->user()->name }}, your inventory list is empty </p>

                                                <button class="btn btn--primary btn--icon btn--outline">
                                                    <img class="icon" src="{{ asset('images/add-commodity-dark.ico') }}" alt="">
                                                    <span class="btn__text">
                                                        <a class="nav-link" href="{{ route('home.create') }}">Add</a>
                                                    </span>
                                                </button>
                                            </div>
                                        @endforelse
                                    @else
                                        unregistered business
                                    @endif


                                </div>

                            </div>

                        </div>

                        <div class="tab-pane fade show" id="nav-category" role="tabpanel" aria-labelledby="nav-category-tab">

                            <div class="pps-commodities">

                                <div class="flex flex-col--wrap scrollable-list">
                                    @if( auth()->user()->businesses()->count() )
                                        @forelse (auth()->user()->categories as $category)
                                        <div class="commodity">
                                            <div class="card">
                                                <header class="card__header">
                                                    <div class="commodity__icon">

                                                        <h3 class="commodity__name">{{  $category->name }}</h3>
                                                    </div>
                                                </header>

                                                <div class="card__body">
                                                    <span class="commodity__acquisition-date">
                                                        <span class="acquisition-text">Created On</span>
                                                            <span class="badge acquisition-date">{{ date('d-m-Y', strtotime($category->created_at)) }}</span>
                                                    </span>
                                                    <span class="commodity__category">
                                                        <span class="category-text">Commodity (s) :</span>
                                                        <div class="category-values">
                                                            @forelse ($category->Commodities as $commodity)
                                                                <a href="{{ route('home.show', $commodity->id) }}" class="link">
                                                                    <span class="badge category-value">{{ $commodity -> name }}</span>
                                                                </a>
                                                            @empty
                                                                <span class="badge category-value">no comodities</span>
                                                            @endforelse
                                                        </div>
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                            <div class="commodity">
                                                <p> {{ auth()->user()->name }}, you dont have any categories yet </p>

                                                <button class="btn btn--primary btn--icon btn--outline">
                                                    <img class="icon" src="{{ asset('images/add-commodity-dark.ico') }}" alt="">
                                                    <span class="btn__text">
                                                        <a class="nav-link" href="{{ route('category.create') }}">Add</a>
                                                    </span>
                                                </button>
                                            </div>
                                        @endforelse
                                    @else
                                        unregistered business
                                    @endif


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
