@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="pps-main-content-title">Available Commoditis To Sell</h2>
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

            <div class="flex flex-col--wrap scrollable-list">
                @forelse ($commodities as $commodity)
                    @if($commodity->Quantity !== null)
                        @if($commodity->Quantity->quantity >= 1)
                            <div class="commodity">
                                <div class="card">
                                    <header class="card__header">
                                        <div class="commodity__icon">
                                            <h3 class="commodity__name">{{ $commodity -> name }}</h3>
                                        </div>
                                        <div class="commodity__tags">
                                            <span class="commodity__price">
                                                <span class="commodity__currency">MWK</span>
                                                @if ($commodity->Price == '')
                                                    <span class="commodity__amount empty">
                                                        price
                                                        <a href="/commodity/{{ $commodity -> id }}/add_commodity_price" role="button" class="btn btn--icon">
                                                        <img class="icon" src="{{ asset('images/add-light.ico') }}" alt="">
                                                        </a>
                                                    </span>
                                                @else
                                                    <span class="commodity__amount">{{ $commodity->Price->price }}</span>
                                                @endif
                                                @if ($commodity->Unit == '')
                                                    <span class="commodity__unit empty">
                                                        /unit
                                                        <a href="/commodity/{{ $commodity -> id }}/add_commodity_unit" role="button" class="btn btn--icon">
                                                        <img class="icon" src="{{ asset('images/add-light.ico') }}" alt="">
                                                        </a>
                                                    </span>
                                                @else
                                                    <span class="commodity__unit">/{{ $commodity->Unit -> unit }}</span>

                                                @endif
                                            </span>
                                        </div>
                                    </header>
                                    <div class="card__body">
                                        <span class="commodity__quantity">
                                            <span class="quantity-text">Available Quantity</span>
                                            <span class="badge quantity-value">
                                                @if ($commodity->Quantity == '')
                                                    empty
                                                @else
                                                    {{ $commodity->Quantity -> quantity }}
                                                @endif
                                            </span>
                                            <span class="commodity__unit">
                                                @if ($commodity->Unit == '')
                                                    Unit
                                                @else
                                                    {{ $commodity->Unit -> unit }}
                                                @endif
                                            </span>
                                        </span>
                                    </div>
                                    <div class="card__btn">
                                        <a href="{{ route('sell_commodity', ['commodity' => $commodity->id]) }}" class="btn btn--category btn--icon">
                                            <span class="icon-container icon--small">
                                                <img class="icon" src="{{ URL("images/sell-dark.ico") }}" alt="">
                                            </span>
                                            <span class="btn__text">Sell</span>
                                        </a>
                                    </div>
                                    <footer class="card__footer">
                                    </footer>
                                </div>
                            </div>

                            @foreach($commodity->Types as $Type)

                                @if ($Type->TypeQuantity !== null)
                                    @if($Type->TypeQuantity->type_quantity >= 1)
                                        <div class="commodity">
                                            <div class="card">
                                                <header class="card__header">
                                                    <div class="commodity__icon">
                                                        <h3 class="commodity__name">{{ $Type -> type_name }}</h3>
                                                    </div>
                                                    <div class="commodity__tags">
                                                        <span class="commodity__price">
                                                            <span class="commodity__currency">MWK</span>
                                                            <span class="commodity__amount">
                                                                @if ($Type->TypePrice == '')
                                                                    @if ($commodity->Price == '')
                                                                        00.00
                                                                    @else
                                                                        {{ $commodity->Price->price }}
                                                                    @endif
                                                                @else
                                                                    {{ $Type->TypePrice->type_price }}
                                                                @endif

                                                            </span>
                                                            <span class="commodity__unit">/
                                                                @if ($commodity->Unit == '')
                                                                    Unit
                                                                @else
                                                                    {{ $commodity->Unit -> unit }}
                                                                @endif
                                                            </span>

                                                        </span>
                                                    </div>
                                                </header>
                                                <div class="card__body">

                                                    <span class="commodity__quantity">
                                                        <span class="quantity-text">Available Quantity</span>
                                                        <span class="badge quantity-value">
                                                            @if ($Type->TypeQuantity == '')
                                                                out of stock
                                                            @else
                                                                {{ $Type->TypeQuantity->type_quantity }}
                                                            @endif
                                                        </span>
                                                        <span class="commodity__unit">
                                                            @if ($commodity->Unit == '')
                                                                Unit
                                                            @else
                                                                {{ $commodity->Unit -> unit }}
                                                            @endif
                                                        </span>
                                                    </span>

                                                </div>
                                                <div class="card__btn">
                                                    <a href="{{ route('sell_type', ['commodity' => $commodity->id, 'type' => $Type->id]) }}" class="btn btn--category btn--icon">
                                                        <span class="icon-container icon--small">
                                                            <img class="icon" src="{{ URL("images/sell-dark.ico") }}" alt="">
                                                        </span>
                                                        <span class="btn__text">Sell</span>
                                                    </a>
                                                </div>
                                                <footer class="card__footer">
                                                </footer>
                                            </div>
                                        </div>
                                        {{--  @elseif($Type->TypeQuantity->type_quantity < 1)  --}}

                                    @endif
                                @endif
                            @endforeach

                            {{--  @elseif ($commodity->Quantity->quantity < 1)  --}}

                        @endif
                    @endif
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

      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

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
                    @forelse ($commodities as $commodity)
                        @if($commodity->Quantity !== null)
                            @if($commodity->Quantity->quantity >= 1)
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
                                    <td>
                                        <span class="data-name">Sell:</span>
                                        <a href="{{ route('sell_commodity', ['commodity' => $commodity->id]) }}" class="btn btn--category btn--icon">
                                            <span class="icon-container icon--small">
                                                <img class="icon" src="{{ URL("images/sell-dark.ico") }}" alt="">
                                            </span>
                                            <span class="btn__text">Sell</span>
                                        </a>
                                    </td>
                                </tr>

                                @foreach($commodity->Types as $Type)

                                    @if ($Type->TypeQuantity !== null)
                                        @if($Type->TypeQuantity->type_quantity >= 1)
                                            <tr>
                                                <th scope="row">{{ $Type -> type_name }}</th>
                                                <td>
                                                    <span class="data-name">Price (K):</span>
                                                    @if ($Type->TypePrice == '')
                                                        00.00
                                                    @else
                                                        {{ $Type->TypePrice->type_price }}
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
                                                    {{ $Type->TypeQuantity->type_quantity }}
                                                </td>
                                                <td>
                                                    <span class="data-name">Sell:</span>
                                                    <a href="{{ route('sell_type', ['commodity' => $commodity->id, 'type' => $Type->id]) }}" class="btn btn--category btn--icon">
                                                        <span class="icon-container icon--small">
                                                            <img class="icon" src="{{ URL("images/sell-dark.ico") }}" alt="">
                                                        </span>
                                                        <span class="btn__text">Sell</span>
                                                    </a>
                                                </td>
                                            </tr>
                                            {{--  @elseif($Type->TypeQuantity->type_quantity < 1)  --}}

                                        @endif
                                    @endif
                                @endforeach

                                {{--  @elseif ($commodity->Quantity->quantity < 1)  --}}
                            @endif
                        @endif
                    @empty
                        Our commodity List is Empty
                    @endforelse

                </tbody>
            </table>
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

@endsection
