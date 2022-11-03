@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="pps-main-content-title">Sales Reports</h2>
  </div>

  <div class="pps-main-content-body">
    <nav class="pps-body-nav">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Budgeted Sales</button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Actual</button>

        </div>
      </nav>
    <div class="tab-content pps-body-content" id="nav-tabContent">

      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

        <div class="scrollable-list">
            <table class="table pps-table">
                <thead>
                    <tr>
                        <th scope="col" class="text-wrap">Name</th>
                        <th scope="col" class="text-wrap">Budgeted Sales (K)</th>
                        <th scope="col" class="text-wrap">Cost (K)</th>
                        <th scope="col" class="text-wrap">Expected Gross Profit (K)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($commodityBudgetedSales as $budgetedSales)
                        @forelse ($commodityPurchases as $Purchases)
                            @if($budgetedSales->commodity_id == $Purchases->commodity_id)
                                <tr>
                                    <th scope="row">{{ $Purchases->CommodityPurchase->name }}</th>
                                    <td>
                                        <span class="data-name">Budgeted Sales (K):</span>
                                        {{ $budgetedSales->quantity * $budgetedSales->selling_price }}
                                    </td>
                                    <td>
                                        <span class="data-name">Cost (K):</span>
                                        {{ $Purchases->quantity * $Purchases->cost_price }}
                                    </td>
                                    <td>
                                        <span class="data-name">Budgeted Gross Profit (K):</span>
                                        {{
                                            ($budgetedSales->quantity * $budgetedSales->selling_price) - ($Purchases->quantity * $Purchases->cost_price)
                                        }}
                                    </td>
                                </tr>
                            @endif
                        @empty
                            No sales and Purchases
                        @endforelse
                    @empty
                        if ($commodityPurchases == NULL)
                        {
                            No Sales and Purchases
                        }
                    @endforelse

                    @foreach ($typeBudgetedSales as $typeSale)

                        @foreach ($typePurchases as $typePurchase)
                            @if($typeSale->commodity_type_id == $typePurchase->commodity_type_id)
                                <tr>
                                    <th scope="row">{{ $typePurchase->CommodityType->type_name }}</th>
                                    <td>
                                        <span class="data-name">Budgeted Sales (K):</span>
                                        {{ $typeSale->selling_price * $typeSale->quantity }}
                                    </td>
                                    <td>
                                        <span class="data-name">Cost (K):</span>
                                        {{ $typePurchase->cost_price * $typePurchase->quantity }}
                                    </td>
                                    <td>
                                        <span class="data-name">Budgeted Gross Profit (K):</span>
                                        {{  ( $typeSale->selling_price * $typeSale->quantity ) - ( $typePurchase->cost_price * $typePurchase->quantity ) }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="card">
            <div class="card__body">

                <span class="commodity__quantity">
                    <span class="quantity-text">Total Budgeted Gross Profit</span>
                    <span class="badge quantity-value">
                        {{ $totalGrossProfit }}
                    </span>
                </span>

            </div>

        </div>

      </div>

      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

        <div class="scrollable-list">
            <table class="table pps-table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Budgeted Sales (K)</th>
                        <th scope="col">Actual Sales (K)</th>
                        <th scope="col">Cost (K)</th>
                        <th scope="col">Gross Profit (K)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($soldCommodityItem as $soldCommodity)
                        @forelse ($commodityBudgetedSales as $budgetedSales)
                            @forelse ($commodityPurchases as $Purchases)
                                @if($budgetedSales->commodity_id == $Purchases->commodity_id)
                                    @if($soldCommodity->commodity_id == $Purchases->commodity_id)
                                        <tr>
                                            <th scope="row">{{ $soldCommodity->SoldCommodity->name }}</th>
                                            <td>
                                                <span class="data-name">Budgeted Sales (K):</span>
                                                {{ $budgetedSales->quantity * $budgetedSales->selling_price }}
                                            </td>
                                            <td>
                                                <span class="data-name">Actual Sales (K):</span>
                                                {{ $soldCommodity->sold_quantity * $soldCommodity->selling_price }}
                                            </td>
                                            <td>
                                                <span class="data-name">Cost (K):</span>
                                                {{ $Purchases->quantity * $Purchases->cost_price }}
                                            </td>
                                            <td>
                                                <span class="data-name">Gross Profit (K):</span>
                                                {{
                                                    ($soldCommodity->sold_quantity * $soldCommodity->selling_price) - ($Purchases->quantity * $Purchases->cost_price)
                                                 }}
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @empty
                            @endforelse
                        @empty
                        @endforelse

                    @empty
                        No sales
                    @endforelse

                    @foreach ($soldTypeItems as $soldType)
                        @foreach ($typeBudgetedSales as $typeSale)

                            @foreach ($typePurchases as $typePurchase)
                                @if($typeSale->commodity_type_id == $typePurchase->commodity_type_id)
                                    @if($soldType->commodity_type_id == $typePurchase->commodity_type_id)

                                        <tr>
                                            <th scope="row">{{ $soldType->SoldType->type_name }}</th>
                                            <td>
                                                <span class="data-name">Budgeted Sales (K):</span>
                                                {{ $typeSale->selling_price * $typeSale->quantity }}
                                            </td>
                                            <td>
                                                <span class="data-name">Actual Sales (K):</span>
                                                {{ $soldType->selling_price * $soldType->sold_quantity }}
                                            </td>
                                            <td>
                                                <span class="data-name">Cost (K):</span>
                                                {{ $typePurchase->cost_price * $typePurchase->quantity }}
                                            </td>
                                            <td>
                                                <span class="data-name">Gross Profit (K):</span>
                                                {{
                                                    ($soldType->selling_price * $soldType->sold_quantity) - ($typePurchase->cost_price * $typePurchase->quantity)
                                                }}
                                            </td>
                                        </tr>

                                    @endif

                                @endif
                            @endforeach
                        @endforeach

                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="card">
            <div class="card__body">

                <span class="commodity__quantity">
                    <span class="quantity-text">Total Actual Sales</span>
                    <span class="badge quantity-value">
                        {{ $totalActualSales }}
                    </span>
                </span>

            </div>

        </div>

      </div>

      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">



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
