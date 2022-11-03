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
                            @forelse ($commodityPurchases as $Purchases)
                                        <tr>
                                            <th scope="row">{{ $Purchases->CommodityPurchase->name }}</th>

                                            <td>
                                                <span class="data-name">Purchase Count:</span>
                                                {{ $Purchases->quantity }}
                                            </td>
                                            <td>
                                                <span class="data-name">Selling Price (K):</span>
                                                @if( $Purchases->CommodityPurchase->CostPrice == null )
                                                    00.00
                                                @else
                                                    {{ $Purchases->CommodityPurchase->CostPrice->cost_price }}
                                                @endif
                                            </td>
                                            <td>
                                                <span class="data-name">Purchases (K):</span>
                                                {{
                                                    $Purchases->quantity * $Purchases->cost_price
                                                }}
                                            </td>
                                            <td>
                                                <span class="data-name">Date:</span>
                                                {{ date('d-m-Y', strtotime($Purchases->purchase_date)) }}
                                            </td>
                                        </tr>
                            @empty
                            @endforelse




                            @foreach ($typePurchases as $typePurchase)

                                        <tr>
                                            <th scope="row">{{ $typePurchase->CommodityType->type_name }}</th>
                                            <td>
                                                <span class="data-name">Purchase Count:</span>
                                                {{ $typePurchase->quantity }}
                                            </td>
                                            <td>
                                                <span class="data-name">Cost Price (K):</span>
                                                {{ $typePurchase->cost_price }}
                                            </td>
                                            <td>
                                                <span class="data-name">Purchase (K):</span>
                                                {{
                                                    $typePurchase->quantity *  $typePurchase->cost_price
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


        <div class="card">
            <div class="card__body">

                <span class="commodity__quantity">
                    <span class="quantity-text">Total Purchas Cost (K)</span>
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
