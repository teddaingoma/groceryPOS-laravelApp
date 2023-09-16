@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="pps-main-content-title"></h2>
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

                <div class="commodity">
                    <div class="card">
                        <header class="card__header">
                            <div class="commodity__icon">

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
                            <div class="btn--group">
                                <a href="{{ route('edit_business', $business) }}" class="btn btn--edit btn--icon">
                                    <span class="icon-container icon--small">
                                        <img class="icon" src="{{ URL("images/edit-filled.ico") }}" alt="">
                                    </span>
                                    <span class="btn__text">edit</span>
                                </a>
                            </div>
                        </footer>
                    </div>
                </div>

            </div>

        </div>
    </div>

  <footer class="pps-main-content-footer">
    <p>
        .
    </p>
  </footer>

@endsection
