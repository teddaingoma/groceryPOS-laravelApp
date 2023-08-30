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
          <button class="nav-link" id="nav-transactions-tab" data-bs-toggle="tab" data-bs-target="#nav-transactions" type="button" role="tab" aria-controls="nav-transactions" aria-selected="true">
            Transactions
        </button>
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

      <div class="tab-pane fade" id="nav-transactions" role="tabpanel" aria-labelledby="nav-transactions-tab">
        @if (auth()->user()->commodityPurchaseInvoices !== null)
            <div class="scrollable-list">
                <table class="table pps-table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Cost Price (K)</th>
                            <th scope="col">Cost (K)</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach(auth()->user()->commodityPurchaseInvoices as $commodityPurchaseInvoice)

                            @if ($commodityPurchaseInvoice->Commodity !== null )

                                <tr>
                                    <th scope="row">
                                        {{--  {{ route('home.show', $commodityPurchaseInvoice->commodity_id) }}  --}}
                                        <a href="" data-bs-toggle="modal" data-bs-target="#commodityPurchaseInvoice_{{ $commodityPurchaseInvoice->id }}">
                                            {{ $commodityPurchaseInvoice->Commodity->name }}
                                        </a>
                                    </th>

                                    <td>
                                        <span class="data-name">Quantity Bought:</span>
                                        {{ $commodityPurchaseInvoice->quantity }}
                                    </td>
                                    <td>
                                        <span class="data-name">Cost Price (K):</span>
                                        {{ $commodityPurchaseInvoice->cost_price }}
                                    </td>
                                    <td>
                                        <span class="data-name">Cost (K):</span>
                                        {{
                                            $commodityPurchaseInvoice->quantity * $commodityPurchaseInvoice->cost_price
                                        }}
                                    </td>
                                    <td>
                                        <span class="data-name">Date:</span>
                                        {{--  {{ $commodityPurchaseInvoice->created_at->diffForHumans() }}  --}}
                                        {{ date('d-m-Y', strtotime($commodityPurchaseInvoice->date_time)) }}
                                    </td>
                                </tr>

                            @endif

                        @endforeach

                        {{--  to populate item transaction details in individual modals  --}}
                        @foreach(auth()->user()->commodityPurchaseInvoices as $commodityPurchaseInvoice)

                            @if ($commodityPurchaseInvoice->Commodity !== null )

                                {{--  Display Full details of a sale transaction using a modal  --}}
                                <div class="modal fade" id="commodityPurchaseInvoice_{{ $commodityPurchaseInvoice->id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="ViewItemPurchaseInvoice" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Purchase Transaction</h5>
                                                <span class="btn icon-container" data-bs-dismiss="modal" aria-label="Close">
                                                    <img class="icon" src="{{ asset('images/close-dark.ico') }}" alt="">
                                                </span>
                                            </div>

                                            <div class="modal-body">
                                                <div class="commodity">
                                                    <div class="card">
                                                        <header class="card__header">
                                                            <div class="commodity__icon">
                                                                <img class="icon" src="{{ asset('commodity_images/' . $commodityPurchaseInvoice->Commodity->image_path) }}" alt="">
                                                                <h3 class="commodity__name">{{ $commodityPurchaseInvoice->Commodity->name }}</h3>
                                                            </div>
                                                        </header>
                                                        <div class="card__body">

                                                            <span class="commodity__quantity">
                                                                <span class="quantity-text">Item Name</span>
                                                                <span class="commodity__unit">
                                                                    {{ $commodityPurchaseInvoice->Commodity->name }}

                                                                </span>
                                                            </span>
                                                            <span class="commodity__quantity">
                                                                <span class="quantity-text">Price</span>
                                                                <span class="commodity__unit">
                                                                    {{ $commodityPurchaseInvoice->cost_price }}
                                                                </span>
                                                            </span>
                                                            <span class="commodity__quantity">
                                                                <span class="quantity-text">Quantity</span>
                                                                <span class="commodity__unit">
                                                                    {{ $commodityPurchaseInvoice->quantity }}

                                                                </span>
                                                            </span>
                                                            <span class="commodity__quantity">
                                                                <span class="quantity-text">Cost</span>
                                                                <span class="commodity__unit">
                                                                    {{
                                                                        $commodityPurchaseInvoice->quantity * $commodityPurchaseInvoice->cost_price
                                                                    }}

                                                                </span>
                                                            </span>
                                                            <span class="commodity__quantity">
                                                                <span class="quantity-text">Time</span>
                                                                <span class="commodity__unit">
                                                                    {{ date('h:i:s', strtotime($commodityPurchaseInvoice->date_time)) }}
                                                                </span>
                                                            </span>
                                                            <span class="commodity__quantity">
                                                                <span class="quantity-text">Date</span>
                                                                <span class="commodity__unit">
                                                                    {{ date('d-m-Y', strtotime($commodityPurchaseInvoice->date_time)) }}
                                                                </span>
                                                            </span>
                                                            <span class="commodity__quantity">
                                                                <span class="quantity-text">Buyer</span>
                                                                <span class="commodity__unit">
                                                                    {{ auth()->user()->name }}
                                                                </span>
                                                            </span>
                                                            <span class="commodity__quantity">
                                                                <span class="quantity-text">Supplier</span>
                                                                <span class="commodity__unit">
                                                                    @if ($commodityPurchaseInvoice->supplier_id !== 0)
                                                                        name
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

                        @foreach (auth()->user()->typePurchaseInvoices as $typePurchaseInvoice)

                        @if ($typePurchaseInvoice->CommodityType !== null )

                            <tr>
                                <th scope="row">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#typePurchaseInvoice_{{ $typePurchaseInvoice->id }}">
                                        {{ $typePurchaseInvoice->CommodityType->type_name }}
                                    </a>
                                </th>

                                <td>
                                    <span class="data-name">Quantity sold:</span>
                                    {{ $typePurchaseInvoice->quantity }}
                                </td>
                                <td>
                                    <span class="data-name">Cost Price (K):</span>
                                    {{ $typePurchaseInvoice->cost_price }}
                                </td>
                                <td>
                                    <span class="data-name">Cost (K):</span>
                                    {{
                                        $typePurchaseInvoice->quantity * $typePurchaseInvoice->cost_price
                                    }}
                                </td>
                                <td>
                                    <span class="data-name">Date:</span>
                                    {{--  {{ $commoditySellInvoice->created_at->diffForHumans() }}  --}}
                                    {{ date('d-m-Y', strtotime($typePurchaseInvoice->date_time)) }}
                                </td>

                            </tr>

                        @endif

                    @endforeach

                    {{--  to populate item transaction details in individual modals  --}}
                    @foreach(auth()->user()->typePurchaseInvoices as $typePurchaseInvoice)

                        @if ($typePurchaseInvoice->CommodityType !== null )

                            {{--  Display Full details of a sale transaction using a modal  --}}
                            <div class="modal fade" id="typePurchaseInvoice_{{ $typePurchaseInvoice->id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="ViewItemPurchaseInvoice" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Transaction</h5>
                                            <span class="btn icon-container" data-bs-dismiss="modal" aria-label="Close">
                                                <img class="icon" src="{{ asset('images/close-dark.ico') }}" alt="">
                                            </span>
                                        </div>

                                        <div class="modal-body">
                                            <div class="commodity">
                                                <div class="card">
                                                    <header class="card__header">
                                                        <div class="commodity__icon">
                                                            <img class="icon" src="{{ asset('commodity_images/' . $typePurchaseInvoice->CommodityType->image_path) }}" alt="">
                                                            <h3 class="commodity__name">{{ $typePurchaseInvoice->CommodityType->type_name }}</h3>
                                                        </div>
                                                    </header>
                                                    <div class="card__body">

                                                        <span class="commodity__quantity">
                                                            <span class="quantity-text">Item Name</span>
                                                            <span class="commodity__unit">
                                                                {{ $typePurchaseInvoice->CommodityType->type_name }}

                                                            </span>
                                                        </span>
                                                        <span class="commodity__quantity">
                                                            <span class="quantity-text">Price</span>
                                                            <span class="commodity__unit">
                                                                {{ $typePurchaseInvoice->cost_price }}
                                                            </span>
                                                        </span>
                                                        <span class="commodity__quantity">
                                                            <span class="quantity-text">Quantity</span>
                                                            <span class="commodity__unit">
                                                                {{ $typePurchaseInvoice->quantity }}

                                                            </span>
                                                        </span>
                                                        <span class="commodity__quantity">
                                                            <span class="quantity-text">Cost</span>
                                                            <span class="commodity__unit">
                                                                {{
                                                                    $typePurchaseInvoice->quantity * $typePurchaseInvoice->cost_price
                                                                }}

                                                            </span>
                                                        </span>
                                                        <span class="commodity__quantity">
                                                            <span class="quantity-text">Time</span>
                                                            <span class="commodity__unit">
                                                                {{ date('h:i:s', strtotime($typePurchaseInvoice->date_time)) }}
                                                            </span>
                                                        </span>
                                                        <span class="commodity__quantity">
                                                            <span class="quantity-text">Date</span>
                                                            <span class="commodity__unit">
                                                                {{ date('d-m-Y', strtotime($typePurchaseInvoice->date_time)) }}
                                                            </span>
                                                        </span>
                                                        <span class="commodity__quantity">
                                                            <span class="quantity-text">Buyer</span>
                                                            <span class="commodity__unit">
                                                                {{ auth()->user()->name }}
                                                            </span>
                                                        </span>
                                                        <span class="commodity__quantity">
                                                            <span class="quantity-text">Supplier</span>
                                                            <span class="commodity__unit">
                                                                @if ($typePurchaseInvoice->supplier_id !== 0)
                                                                    name
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
                            {{ auth()->user()->name }}, Purchases report will show as you make transactions
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
