@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="pps-main-content-title">Available Commodities To Sell</h2>
  </div>

  <div class="pps-main-content-body">
    <nav class="pps-body-nav">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tabs</button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">List</button>
        </div>
      </nav>
    <div class="tab-content pps-body-content" id="nav-tabContent">

      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

        <div class="pps-commodities">

            @if(auth()->user()->commodities !== null)

                <div class="flex flex-col--wrap scrollable-list">

                    @foreach (auth()->user()->commodities as $commodity)
                        @if ($commodity->business_id == auth()->user()->businesses->id)

                            @if($commodity->Quantity !== null && $commodity->Quantity->quantity > 0)
                                <x-available-commodity :commodity="$commodity" />

                                @foreach($commodity->Types as $type)
                                    @if ($type->TypeQuantity !== null && $type->TypeQuantity->type_quantity > 0)
                                        <x-available-type :type="$type" :commodity="$commodity" />
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    @endforeach

                </div>

            @else
                <div class="commodity">
                    <p> {{ auth()->user()->name }}, your inventory list is empty </p>

                    <button class="btn btn--primary btn--icon btn--outline">
                        <img class="icon" src="{{ asset('images/add-commodity-dark.ico') }}" alt="">
                        <span class="btn__text">
                            <a class="nav-link" href="{{ route('home.create') }}">Add</a>
                        </span>
                    </button>
                </div>
            @endif

        </div>

      </div>

      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

        @if(auth()->user()->commodities !== null)

            <div class="scrollable-list">
                <table class="table pps-table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-wrap">Name</th>
                            <th scope="col" class="text-wrap">Price (K)</th>
                            <th scope="col" class="text-wrap">Quantity</th>
                            <th scope="col" class="text-wrap">Sell</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach (auth()->user()->commodities as $commodity)
                            @if($commodity->Quantity !== null && $commodity->Quantity->quantity > 0)

                                <x-commodity-row :commodity="$commodity" />

                                @foreach($commodity->Types as $type)
                                    @if ($type->TypeQuantity !== null && $type->TypeQuantity->type_quantity > 0)

                                        <x-type-row :type="$type" :commodity="$commodity" />

                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        @else

            <div class="commodity">
                <p> {{ auth()->user()->name }}, your inventory list is empty </p>

                <button class="btn btn--primary btn--icon btn--outline">
                    <img class="icon" src="{{ asset('images/add-commodity-dark.ico') }}" alt="">
                    <span class="btn__text">
                        <a class="nav-link" href="{{ route('home.create') }}">Add</a>
                    </span>
                </button>
            </div>

        @endif


      </div>

    </div>
  </div>

  <footer class="pps-main-content-footer">

    <div class="commodity">
        <div class="card">
            <div class="card__body">
                Available Commodities
            </div>
        </div>
    </div>

  </footer>

@endsection
