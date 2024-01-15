@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <span class="icon-container icon--circle">
        <img class="icon" src="{{ asset('images/inventory-dark.ico') }}" alt="">
    </span>
    <h2 class="pps-main-content-title title-case-lower">Available Commodities To Sell</h2>
  </div>

  <div class="pps-main-content-body">
    <nav class="pps-body-nav">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-tabs-tab" data-bs-toggle="tab" data-bs-target="#nav-tabs" type="button" role="tab" aria-controls="nav-tabs" aria-selected="true">Tabs view</button>
          <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="false">List view</button>
          <button class="nav-link" id="nav-inventory-tab" data-bs-toggle="tab" data-bs-target="#nav-inventory" type="button" role="tab" aria-controls="nav-inventory" aria-selected="false">Commodities</button>
        </div>
      </nav>
    <div class="tab-content pps-body-content" id="nav-tabContent">

      <div class="tab-pane fade show active" id="nav-tabs" role="tabpanel" aria-labelledby="nav-tabs-tab">

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

      <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">

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

      <div class="tab-pane fade" id="nav-inventory" role="tabpanel" aria-labelledby="nav-inventory-tab">

        <div class="pps-commodities">

            <div class="flex flex-col--wrap scrollable-list">

                @if( auth()->user()->businesses()->count() )
                    @forelse ($commodities as $commodity)
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js" integrity="sha512-7U4rRB8aGAHGVad3u2jiC7GA5/1YhQcQjxKeaVms/bT66i3LVBMRcBI9KwABNWnxOSwulkuSXxZLGuyfvo7V1A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    var _ydata = JSON.parse('{!! json_encode($months) !!}');
    var _xdata = JSON.parse('{!! json_encode($monthCount) !!}');
  </script>
  <script src="{{ asset('js/bar_chart.js') }}"></script>


@endsection
