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
                <button class="nav-link" id="nav-transactions-tab" data-bs-toggle="tab" data-bs-target="#nav-transactions" type="button" role="tab" aria-controls="nav-transactions" aria-selected="true">
                    Transactions
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
                            <span class="quantity-text">Total Actual Sales</span>
                            <span class="badge quantity-value">
                                MWK {{ $totalActualSales }}
                            </span>
                        </span>

                    </div>

                </div>
            </div>

            <div class="tab-pane fade" id="nav-transactions" role="tabpanel" aria-labelledby="nav-transactions-tab">
                @if (auth()->user()->commoditySellInvoices !== null)
                    <div class="scrollable-list">
                        <table class="table pps-table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Selling Price (K)</th>
                                    <th scope="col">Cost (K)</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach(auth()->user()->commoditySellInvoices as $commoditySellInvoice)

                                    @if ($commoditySellInvoice->Commodity !== null )

                                        <tr>
                                            <th scope="row">
                                                {{--  {{ route('home.show', $commoditySellInvoice->commodity_id) }}  --}}
                                                <a href="" data-bs-toggle="modal" data-bs-target="#itemSellInvoice_{{ $commoditySellInvoice->id }}">
                                                    {{ $commoditySellInvoice->Commodity->name }}
                                                </a>
                                            </th>

                                            <td>
                                                <span class="data-name">Quantity sold:</span>
                                                {{ $commoditySellInvoice->sell_quantity }}
                                            </td>
                                            <td>
                                                <span class="data-name">Selling Price (K):</span>
                                                {{ $commoditySellInvoice->selling_price }}
                                            </td>
                                            <td>
                                                <span class="data-name">Cost (K):</span>
                                                {{
                                                    $commoditySellInvoice->sell_quantity * $commoditySellInvoice->selling_price
                                                }}
                                            </td>
                                            <td>
                                                <span class="data-name">Date:</span>
                                                {{--  {{ $commoditySellInvoice->created_at->diffForHumans() }}  --}}
                                                {{ date('d-m-Y', strtotime($commoditySellInvoice->date_time)) }}
                                            </td>
                                        </tr>

                                    @endif

                                @endforeach

                                {{--  to populate item transaction details in individual modals  --}}
                                @foreach(auth()->user()->commoditySellInvoices as $commoditySellInvoice)

                                    @if ($commoditySellInvoice->Commodity->name !== null )

                                        {{--  Display Full details of a sale transaction using a modal  --}}
                                        <div class="modal fade" id="itemSellInvoice_{{ $commoditySellInvoice->id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="ViewItemSellInvoice" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">

                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sell Transaction</h5>
                                                        <span class="btn icon-container" data-bs-dismiss="modal" aria-label="Close">
                                                            <img class="icon" src="{{ asset('images/close-dark.ico') }}" alt="">
                                                        </span>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="commodity">
                                                            <div class="card">
                                                                <header class="card__header">
                                                                    <div class="commodity__icon">
                                                                        <img class="icon" src="{{ asset('commodity_images/' . $commoditySellInvoice->Commodity->image_path) }}" alt="">
                                                                        <h3 class="commodity__name">{{ $commoditySellInvoice->Commodity->name }}</h3>
                                                                    </div>
                                                                </header>
                                                                <div class="card__body">

                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Item Name</span>
                                                                        <span class="commodity__unit">
                                                                            {{ $commoditySellInvoice->Commodity->name }}

                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Price</span>
                                                                        <span class="commodity__unit">
                                                                            {{ $commoditySellInvoice->selling_price }}
                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Quantity</span>
                                                                        <span class="commodity__unit">
                                                                            {{ $commoditySellInvoice->sell_quantity }}

                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Cost</span>
                                                                        <span class="commodity__unit">
                                                                            {{
                                                                                $commoditySellInvoice->sell_quantity * $commoditySellInvoice->selling_price
                                                                            }}

                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Amount Paid</span>
                                                                        <span class="commodity__unit">
                                                                            {{ $commoditySellInvoice->payment }}

                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Change</span>
                                                                        <span class="commodity__unit">
                                                                            {{
                                                                                ($commoditySellInvoice->payment) - ($commoditySellInvoice->sell_quantity * $commoditySellInvoice->selling_price)
                                                                             }}
                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Time</span>
                                                                        <span class="commodity__unit">
                                                                            {{ date('h:i:s', strtotime($commoditySellInvoice->date_time)) }}
                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Date</span>
                                                                        <span class="commodity__unit">
                                                                            {{ date('d-m-Y', strtotime($commoditySellInvoice->date_time)) }}
                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Seller</span>
                                                                        <span class="commodity__unit">
                                                                            {{ auth()->user()->name }}
                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Buyer</span>
                                                                        <span class="commodity__unit">
                                                                            @if ($commoditySellInvoice->customer_id !== 0)
                                                                                {{ $commoditySellInvoice->Customer->name }}
                                                                            @else

                                                                            @endif
                                                                        </span>
                                                                    </span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        Footer
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach

                                @foreach (auth()->user()->typeSellInvoices as $typeSellInvoice)

                                    @if ($typeSellInvoice->CommodityType !== null )

                                        <tr>
                                            <th scope="row">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#itemSellInvoice_{{ $typeSellInvoice->id }}">
                                                    {{ $typeSellInvoice->CommodityType->type_name }}
                                                </a>
                                            </th>

                                            <td>
                                                <span class="data-name">Quantity sold:</span>
                                                {{ $typeSellInvoice->sell_quantity }}
                                            </td>
                                            <td>
                                                <span class="data-name">Selling Price (K):</span>
                                                {{ $typeSellInvoice->selling_price }}
                                            </td>
                                            <td>
                                                <span class="data-name">Cost (K):</span>
                                                {{
                                                    $typeSellInvoice->sell_quantity * $typeSellInvoice->selling_price
                                                }}
                                            </td>
                                            <td>
                                                <span class="data-name">Date:</span>
                                                {{--  {{ $commoditySellInvoice->created_at->diffForHumans() }}  --}}
                                                {{ date('d-m-Y', strtotime($typeSellInvoice->date_time)) }}
                                            </td>

                                        </tr>

                                    @endif

                                @endforeach

                                {{--  to populate item transaction details in individual modals  --}}
                                @foreach(auth()->user()->typeSellInvoices as $typeSellInvoice)

                                    @if ($commoditySellInvoice->Commodity->name !== null )

                                        {{--  Display Full details of a sale transaction using a modal  --}}
                                        <div class="modal fade" id="itemSellInvoice_{{ $typeSellInvoice->id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="ViewItemSellInvoice" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">

                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sell Transaction</h5>
                                                        <span class="btn icon-container" data-bs-dismiss="modal" aria-label="Close">
                                                            <img class="icon" src="{{ asset('images/close-dark.ico') }}" alt="">
                                                        </span>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="commodity">
                                                            <div class="card">
                                                                <header class="card__header">
                                                                    <div class="commodity__icon">
                                                                        <img class="icon" src="{{ asset('commodity_images/' . $typeSellInvoice->CommodityType->image_path) }}" alt="">
                                                                        <h3 class="commodity__name">{{ $typeSellInvoice->CommodityType->type_name }}</h3>
                                                                    </div>
                                                                </header>
                                                                <div class="card__body">

                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Item Name</span>
                                                                        <span class="commodity__unit">
                                                                            {{ $typeSellInvoice->CommodityType->type_name }}

                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Price</span>
                                                                        <span class="commodity__unit">
                                                                            {{ $typeSellInvoice->selling_price }}
                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Quantity</span>
                                                                        <span class="commodity__unit">
                                                                            {{ $typeSellInvoice->sell_quantity }}

                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Cost</span>
                                                                        <span class="commodity__unit">
                                                                            {{
                                                                                $typeSellInvoice->sell_quantity * $typeSellInvoice->selling_price
                                                                            }}

                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Amount Paid</span>
                                                                        <span class="commodity__unit">
                                                                            {{ $typeSellInvoice->payment }}

                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Change</span>
                                                                        <span class="commodity__unit">
                                                                            {{
                                                                                ($typeSellInvoice->payment) - ($typeSellInvoice->sell_quantity * $typeSellInvoice->selling_price)
                                                                             }}
                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Time</span>
                                                                        <span class="commodity__unit">
                                                                            {{ date('h:i:s', strtotime($typeSellInvoice->date_time)) }}
                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Date</span>
                                                                        <span class="commodity__unit">
                                                                            {{ date('d-m-Y', strtotime($typeSellInvoice->date_time)) }}
                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Seller</span>
                                                                        <span class="commodity__unit">
                                                                            {{ auth()->user()->name }}
                                                                        </span>
                                                                    </span>
                                                                    <span class="commodity__quantity">
                                                                        <span class="quantity-text">Buyer</span>
                                                                        <span class="commodity__unit">
                                                                            @if ($typeSellInvoice->customer_id !== 0)
                                                                                {{ $typeSellInvoice->Customer->name }}
                                                                            @else

                                                                            @endif
                                                                        </span>
                                                                    </span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        Footer
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach

                            </tbody>
                        </table>
                    </div>

                @else
                    <div class="card">
                        <div class="card__body">

                            <span class="commodity__quantity">
                                <span class="badge quantity-value">
                                    {{ auth()->user()->name }}, Sales report will show as you make transactions
                                </span>
                            </span>

                        </div>

                    </div>
                @endif

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
