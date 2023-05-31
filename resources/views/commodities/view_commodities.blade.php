@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="pps-main-content-title">Dashboard</h2>
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

            <div class="flex flex-col--wrap scrollable-list">
                @forelse ($commodities as $commodity)
                    <x-commodity :commodity="$commodity" />
                @empty
                    <div class="commodity">
                        <div class="card">
                            <header class="card__header">

                                <span class="commodity__description">Our commodity's list is empty</span>

                            </header>
                            <div class="card__body">
                                Our commodity's list is empty
                            </div>
                            <footer class="card__footer">
                                <small class="text-muted">
                                    <button class="btn btn--primary btn--icon btn--outline">
                                        <span class="icon-container icon--small">
                                            <img class="icon" src="images/play.ico" alt="">
                                        </span>
                                        <span class="btn__text">view</span>
                                    </button>
                                </small>
                            </footer>
                        </div>
                    </div>
                @endforelse

            </div>

        </div>

      </div>

    </div>
  </div>

  <footer class="pps-main-content-footer">

    <div class="commodity">
        <div class="card">
            <div class="card__body">

            </div>
        </div>
    </div>

  </footer>

@endsection
