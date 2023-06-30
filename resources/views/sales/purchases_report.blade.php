@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="pps-main-content-title">Purchases Report</h2>
  </div>

  <div class="pps-main-content-body">
    <nav class="pps-body-nav">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Purchases</button>

        </div>
      </nav>
    <div class="tab-content pps-body-content" id="nav-tabContent">

      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        @if (auth()->user()->commodityPurchases)
            <div class="scrollable-list">
                <table class="table pps-table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Purchase Count</th>
                            <th scope="col">Cost Price (K)</th>
                            <th scope="col">Purchases (K)</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach (auth()->user()->commodityPurchases as $Purchases)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('home.show', $Purchases->commodity_id) }}">
                                        {{ $Purchases->CommodityPurchase->name }}
                                    </a>
                                </th>

                                <td>
                                    <span class="data-name">Purchase Count:</span>
                                    {{ $Purchases->quantity }}
                                </td>
                                <td>
                                    <span class="data-name">Cost Price (K):</span>
                                    {{ $Purchases->CommodityPurchase->CostPrice->cost_price }}
                                </td>
                                <td>
                                    <span class="data-name">Purchases (K):</span>
                                    {{
                                        $Purchases->quantity * $Purchases->CommodityPurchase->CostPrice->cost_price
                                    }}
                                </td>
                                <td>
                                    <span class="data-name">Date:</span>
                                    {{ date('d-m-Y', strtotime($Purchases->purchase_date)) }}
                                </td>
                            </tr>
                        @endforeach

                        @foreach (auth()->user()->typePurchases as $typePurchase)

                            <tr>
                                <th scope="row">
                                    <a href="{{ route('show_commodity_type', ['commodity' => $typePurchase->commodity_id, 'type' => $typePurchase->commodity_type_id]) }}">
                                        {{ $typePurchase->CommodityType->type_name }}
                                    </a>
                                </th>
                                <td>
                                    <span class="data-name">Purchase Count:</span>
                                    {{ $typePurchase->quantity }}
                                </td>
                                <td>
                                    <span class="data-name">Cost Price (K):</span>
                                    {{ $typePurchase->CommodityType->TypeCostPrice->type_cost_price }}
                                </td>
                                <td>
                                    <span class="data-name">Purchase (K):</span>
                                    {{
                                        $typePurchase->quantity *  $typePurchase->CommodityType->TypeCostPrice->type_cost_price
                                    }}
                                </td>
                                <td>
                                    <span class="data-name">Date:</span>
                                    {{ date('d-m-Y', strtotime($typePurchase->purchase_date)) }}
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>

        @else
           <div class="card">
                <div class="card__body">

                    <span class="commodity__quantity">
                        <span class="badge quantity-value">
                            {{ auth()->user()->name }}, purchase report will show as you make transactions
                        </span>
                    </span>

                </div>

            </div>
        @endif


        <div class="card">
            <div class="card__body">

                <span class="commodity__quantity">
                    <span class="quantity-text">Total Purchase Cost (K)</span>
                    <span class="badge quantity-value">
                        {{ $totalPurchaseCosts }}
                    </span>
                </span>

            </div>

        </div>

      </div>

    </div>
  </div>

  <footer class="pps-main-content-footer">

    <div class="commodity">
        <div class="card">
            <div class="card__body">
                View Sales Reports
            </div>
        </div>
    </div>

  </footer>

@endsection
