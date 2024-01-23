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
            <img class="icon" src="{{ ('/images/logo-dark.ico') }}" alt="">
        </span>
        <h2 class="pps-main-content-title title-case-lower">business |
            @if (auth()->user()->businesses !== null)
                {{  $business->name }}
            @else
                Unregistered Business
            @endif
        </h2>
    </div>

  <div class="pps-main-content-body">

        <div class="pps-commodities">

            @if (auth()->user()->businesses !== null)

                <div class="commodity">
                    <div class="card card--secondary">
                        <header class="card__header">
                            <div class="commodity__icon">
                                <img class="icon" src="{{ asset('images/business.ico') }}" alt="">
                                <h3 class="commodity__name">{{  $business->name }}</h3>
                            </div>
                            <div class="commodity__tags">
                                <span class="commodity__description">{{ $business->description }}</span>
                            </div>
                        </header>

                        <div class="card__body">
                            <span class="commodity__acquisition-date">
                                <span class="acquisition-text">Registered On</span>

                                    <span class="badge acquisition-date">{{ date('d-m-Y', strtotime($business->created_at)) }}</span>

                            </span>
                            <span class="commodity__acquisition-date">
                                <span class="acquisition-text"> <strong> Items Sold </strong> </span>
                            </span>
                            <div class="scrollable-list">
                                <table class="table pps-table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-wrap">Name</th>
                                            <th scope="col" class="text-wrap">Price (K)</th>
                                            <th scope="col" class="text-wrap">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach (auth()->user()->commodities as $commodity)
                                            @if($commodity->Quantity !== null && $commodity->Quantity->quantity > 0)

                                            <tr>
                                                <th scope="row">{{ $commodity -> name }}</th>
                                                <td>
                                                    <span class="data-name">Price (K):</span>
                                                    @if ($commodity->Price == '')
                                                        00.00
                                                    @else
                                                        {{ $commodity->Price->price }}
                                                    @endif
                                                    /
                                                    @if ($commodity->Unit == '')
                                                        unit
                                                    @else
                                                        {{ $commodity->Unit -> unit }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="data-name">Quantity:</span>
                                                    {{ $commodity->Quantity -> quantity }}
                                                </td>
                                            </tr>

                                                @foreach($commodity->Types as $type)
                                                    @if ($type->TypeQuantity !== null && $type->TypeQuantity->type_quantity > 0)

                                                    <tr>
                                                        <th scope="row">{{ $type -> type_name }}</th>
                                                        <td>
                                                            <span class="data-name">Price (K):</span>
                                                            @if ($type->TypePrice == '')
                                                                00.00
                                                            @else
                                                                {{ $type->TypePrice->type_price }}
                                                            @endif
                                                            /
                                                            @if ($commodity->Unit == '')
                                                                Unit
                                                            @else
                                                                {{ $commodity->Unit -> unit }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="data-name">Quantity:</span>
                                                            {{ $type->TypeQuantity->type_quantity }}
                                                        </td>
                                                    </tr>

                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <footer class="card__footer">

                            <div class="card__divider"></div>

                        </footer>
                    </div>
                </div>

            @else
                <div class="commodity">
                    <div class="card card--secondary">
                        <header class="card__header">
                            No registered Business
                        </header>
                    </div>
                </div>
            @endif

        </div>

  </div>

  <footer class="pps-main-content-footer">
    <p>
        @if (auth()->user()->businesses !== null)
            Business | {{  $business->name }}
        @else
            Unregistered Business
        @endif
    </p>
  </footer>

@endsection
