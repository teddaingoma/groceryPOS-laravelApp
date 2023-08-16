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

                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                    Budgeted Sales
                </button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                    Actual Sales
                </button>

            </div>
        </nav>
        <div class="tab-content pps-body-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                @if(auth()->user()->commodityBudgetedSales !== null)
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

                            @foreach (auth()->user()->commodityBudgetedSales as $budgetedSales)

                                <x-commodity-row2 :budgetedSales="$budgetedSales" />

                            @endforeach

                            @foreach(auth()->user()->typeBudgetedSales as $typeSale)

                                {{--  <x-type-row2 :typeSale="$typeSale" />  --}}
                                <tr>
                                    <th scope="row">
                                        <a href="{{ route('show_commodity_type', ['commodity' => $typeSale->commodity_id, 'type' => $typeSale->commodity_type_id]) }}">
                                            {{ $typeSale->CommodityType->type_name }}
                                        </a>
                                    </th>
                                    <td>
                                        <span class="data-name">Budgeted Sales (K):</span>
                                        {{ $typeSale->CommodityType->TypePrice->type_price * $typeSale->quantity }}
                                    </td>
                                    <td>
                                        <span class="data-name">Cost (K):</span>
                                        {{ $typeSale->CommodityType->TypeCostPrice->type_cost_price * $typeSale->quantity }}
                                    </td>
                                    <td>
                                        <span class="data-name">Budgeted Gross Profit (K):</span>
                                        {{
                                            ( $typeSale->CommodityType->TypePrice->type_price * $typeSale->quantity ) -
                                            ( $typeSale->CommodityType->TypeCostPrice->type_cost_price * $typeSale->quantity )
                                        }}
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
                                    {{ auth()->user()->name }}, sales report will show as you make transactions
                                </span>
                            </span>

                        </div>

                    </div>
                @endif

                <div class="card">
                    <div class="card__body">

                        <span class="commodity__quantity">
                            <span class="quantity-text">Total Budgeted Gross Profit</span>
                            <span class="badge quantity-value">
                                MWK {{ $totalGrossProfit }}
                            </span>
                        </span>

                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                @if (auth()->user()->soldCommodityItem !== null)
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

                                @foreach (auth()->user()->soldCommodityItem as $soldCommodity )

                                    <tr>
                                        <th scope="row">{{ $soldCommodity->SoldCommodity->name }}</th>
                                        <td>
                                            <span class="data-name">Budgeted Sales (K):</span>
                                            {{ $soldCommodity->SoldCommodity->CommodityBudgetedSales->quantity * $soldCommodity->SoldCommodity->Price->price }}
                                        </td>
                                        <td>
                                            <span class="data-name">Actual Sales (K):</span>
                                            {{ $soldCommodity->sold_quantity * $soldCommodity->SoldCommodity->Price->price }}
                                        </td>
                                        <td>
                                            <span class="data-name">Cost (K):</span>
                                            {{ $soldCommodity->SoldCommodity->CommodityPurchases->quantity * $soldCommodity->SoldCommodity->CostPrice->cost_price }}
                                        </td>
                                        <td>
                                            <span class="data-name">Gross Profit (K):</span>
                                            {{
                                                ( $soldCommodity->sold_quantity * $soldCommodity->SoldCommodity->Price->price ) -
                                                ( $soldCommodity->SoldCommodity->CommodityPurchases->quantity * $soldCommodity->SoldCommodity->CostPrice->cost_price )
                                             }}
                                        </td>
                                    </tr>

                                @endforeach

                                @foreach (auth()->user()->soldTypeItem as $soldType )

                                    <tr>
                                        <th scope="row">{{ $soldType->SoldType->type_name }}</th>
                                        <td>
                                            <span class="data-name">Budgeted Sales (K):</span>
                                            {{ $soldType->SoldType->TypeBudgetedSale->quantity * $soldType->SoldType->TypePrice->type_price }}
                                        </td>
                                        <td>
                                            <span class="data-name">Actual Sales (K):</span>
                                            {{ $soldType->sold_quantity * $soldType->SoldType->TypePrice->type_price }}
                                        </td>
                                        <td>
                                            <span class="data-name">Cost (K):</span>
                                            {{ $soldType->SoldType->TypePurchase->quantity * $soldType->SoldType->TypeCostPrice->type_cost_price }}
                                        </td>
                                        <td>
                                            <span class="data-name">Gross Profit (K):</span>
                                            {{
                                                ( $soldType->sold_quantity * $soldType->SoldType->TypePrice->type_price ) -
                                                ( $soldType->SoldType->TypePurchase->quantity * $soldType->SoldType->TypeCostPrice->type_cost_price )
                                             }}
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                @else
                    <div class="card">
                        <div class="card__body">

                            <span class="commodity__quantity">
                                <span class="badge quantity-value">
                                    {{ auth()->user()->name }}, sales report will show as you make transactions
                                </span>
                            </span>

                        </div>

                    </div>
                @endif

                <div class="card">
                    <div class="card__body">

                        <span class="commodity__quantity">
                            <span class="quantity-text">Total Actual Sales</span>
                            <span class="badge quantity-value">
                                MWK {{ $totalActualSales }}
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
