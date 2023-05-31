@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="pps-main-content-title">{{ $commodity -> name }}</h2>
  </div>

  <div class="pps-main-content-body">
    <nav class="pps-body-nav">
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Commodities</button>
      </div>
    </nav>
    <div class="tab-content pps-body-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

            <div class="pps-commodities">

                <x-show-commodity :commodity="$commodity" />

            </div>

            <div class="content-header">
                <h3 class="title">Type (s) of {{ $commodity->name }}</h3>
            </div>

            <div class="flex flex-col--wrap scrollable-list">
                @forelse ($commodity->Types as $type)
                    <x-type :type="$type" :commodity="$commodity" />
                @empty
                    <div class="commodity">
                        <div class="card">
                            <header class="card__header">

                                <span class="commodity__description">{{ $commodity->name }} has no types</span>

                            </header>
                            <div class="card__body text-wrap">
                                If {{ $commodity->name }} has a variety of types or flavours, add them
                            </div>
                            <footer class="card__footer mx-auto">
                                <small class="text-muted">
                                    <a href="/commodity/{{ $commodity -> id }}/add_commodity_type" role="button" class="btn btn--primary btn--icon">
                                        <span class="icon-container icon--small">
                                            <img class="icon" src="{{ asset('images/add-light.ico') }}" alt="">
                                        </span>
                                    </a>
                                </small>
                            </footer>
                        </div>
                    </div>
                @endforelse
            </div>
            </div>

        </div>
    </div>

  <footer class="pps-main-content-footer">
    <p>
        {{ $commodity->description }}
    </p>
  </footer>

@endsection
