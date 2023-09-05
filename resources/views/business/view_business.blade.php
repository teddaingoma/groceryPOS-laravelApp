@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="pps-main-content-title">{{  }}</h2>
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



            </div>

        </div>
    </div>

  <footer class="pps-main-content-footer">
    <p>
        .
    </p>
  </footer>

@endsection
