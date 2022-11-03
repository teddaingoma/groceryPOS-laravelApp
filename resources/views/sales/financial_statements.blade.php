@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="pps-main-content-title">Financial Statements</h2>
  </div>

  <div class="pps-main-content-body">
    <nav class="pps-body-nav">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Income Statement</button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Balance Sheet</button>
          <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Cash Flows</button>
        </div>
      </nav>
    <div class="tab-content pps-body-content" id="nav-tabContent">

      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

        <div class="commodity financial-statement">
            <div class="card">
                <header class="card__header">
                    <div class="commodity__icon">
                        <img class="icon" src="{{ asset('images/item-light.ico') }}" alt="">
                        <h3 class="commodity__name">Statement of Profit or Loss of [Business_Name] as at {{ date('Y') }}</h3>
                    </div>
                </header>
                <div class="card__body collapsible">
                  <span class="commodity__quantity statement--head">
                    <span class="quantity-text"></span>
                    <span class="commodity__unit">K</span>
                    <span class="commodity__unit">K</span>
                  </span>
                  <span class="commodity__acquisition-date statement--body">
                    <span class="acquisition-text collapsible__header">
                      Sales
                    </span>
                    <span class="badge acquisition-date"></span>
                    <span class="badge acquisition-date">{{ $totalActualSales }}</span>
                  </span>
                  <span class="commodity__acquisition-date statement--body">
                    <span class="acquisition-text collapsible__header">
                      Cost of Sales
                    </span>
                    <span class="badge acquisition-date"></span>
                    <span class="badge acquisition-date">{{ $totalPurchaseCosts }}</span>
                  </span>
                  <span class="commodity__acquisition-date statement--body total">
                    <span class="acquisition-text">Gross Profit</span>
                    <span class="badge acquisition-date"></span>
                    <span class="badge acquisition-date">
                        @if( ( $totalActualSales - $totalPurchaseCosts ) < 0 )
                            ({{ ( $totalActualSales - $totalPurchaseCosts ) * -1 }})
                        @elseif( ( $totalActualSales - $totalPurchaseCosts ) > 0 )
                            {{ $totalActualSales - $totalPurchaseCosts }}
                        @endif
                    </span>
                  </span>
                  <span class="commodity__acquisition-date statement--body">
                    <span class="acquisition-text">General Expenses</span>
                    <span class="badge acquisition-date"></span>
                    <span class="badge acquisition-date">(0)</span>
                  </span>
                  <span class="commodity__acquisition-date statement--body total">
                    <span class="acquisition-text">Net Profit (or loss)</span>
                    <span class="badge acquisition-date"></span>
                    <span class="badge acquisition-date">
                        @if( ( $totalActualSales - $totalPurchaseCosts ) < 0 )
                            ({{ ( $totalActualSales - $totalPurchaseCosts ) * -1 }})
                        @elseif( ( $totalActualSales - $totalPurchaseCosts ) > 0 )
                            {{ $totalActualSales - $totalPurchaseCosts }}
                        @endif
                    </span>
                  </span>
                </div>
                <footer class="card__footer">
                  <div class="card__divider"></div>
                </footer>
            </div>
        </div>

      </div>

      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

        <div class="commodity financial-statement">
            <div class="card">
                <header class="card__header">
                    <div class="commodity__icon">
                        <img class="icon" src="{{ asset('images/item-light.ico') }}" alt="">
                        <h3 class="commodity__name">Statement of Financial Position of [Business_Name] as at [DD/MM/YYYY]</h3>
                    </div>
                </header>
                <div class="card__body collapsible">
                  <span class="commodity__quantity statement--head">
                    <span class="quantity-text"></span>
                    <span class="commodity__unit">K</span>
                    <span class="commodity__unit">K</span>
                  </span>
                  <span class="commodity__acquisition-date statement--body">
                    <span class="acquisition-text collapsible__header">
                      Assets: Inventories
                      <img src="../images/chevron-dark.ico" alt="" class="icon icon--white collapsible__chevron">
                    </span>
                    <span class="badge acquisition-date"></span>
                    <span class="badge acquisition-date">{{ $totalPurchaseCosts }}</span>
                  </span>
                  <div class="inventories collapsible__content">
                    <div class="scrollable-list">
                        @forelse ($soldCommodityItem as $soldCommodity)
                            @forelse ($commodityBudgetedSales as $budgetedSales)
                                @forelse ($commodityPurchases as $Purchases)
                                    @if($budgetedSales->commodity_id == $Purchases->commodity_id)
                                        @if($soldCommodity->commodity_id == $Purchases->commodity_id)
                                            <span class="commodity__acquisition-date statement--body asset">
                                                <span class="acquisition-text">{{ $soldCommodity->SoldCommodity->name }}</span>
                                                <span class="badge acquisition-date">{{ $Purchases->quantity * $Purchases->cost_price }}</span>
                                                <span class="badge acquisition-date">{{ $Purchases->quantity * $Purchases->cost_price }}</span>
                                            </span>
                                        @endif
                                    @endif
                                @empty
                                @endforelse
                            @empty
                            @endforelse
                        @empty
                            No Purchases Made
                        @endforelse

                        @foreach ($soldTypeItems as $soldType)
                            @foreach ($typeBudgetedSales as $typeSale)

                                @foreach ($typePurchases as $typePurchase)
                                    @if($typeSale->commodity_type_id == $typePurchase->commodity_type_id)
                                        @if($soldType->commodity_type_id == $typePurchase->commodity_type_id)
                                            <span class="commodity__acquisition-date statement--body asset">
                                                <span class="acquisition-text">{{ $soldType->SoldType->type_name }}</span>
                                                <span class="badge acquisition-date">{{ $typePurchase->cost_price * $typePurchase->quantity }}</span>
                                                <span class="badge acquisition-date">{{ $typePurchase->cost_price * $typePurchase->quantity }}</span>
                                            </span>
                                        @endif

                                    @endif
                                @endforeach
                            @endforeach

                        @endforeach
                    </div>
                    <span class="commodity__acquisition-date statement--body asset subtotal">
                      <span class="acquisition-text">Subtotal</span>
                      <span class="badge acquisition-date">{{ $totalPurchaseCosts }}</span>
                      <span class="badge acquisition-date">{{ $totalPurchaseCosts }}</span>
                    </span>
                  </div>
                  <span class="commodity__acquisition-date statement--body total">
                    <span class="acquisition-text">Total Assets</span>
                    <span class="badge acquisition-date"></span>
                    <span class="badge acquisition-date">{{ $totalPurchaseCosts }}</span>
                  </span>
                  <span class="commodity__acquisition-date statement--body">
                    <span class="acquisition-text">Capital: Invested on Inventories</span>
                    <span class="badge acquisition-date"></span>
                    <span class="badge acquisition-date">{{ $totalPurchaseCosts }}</span>
                  </span>
                  <span class="commodity__acquisition-date statement--body total">
                    <span class="acquisition-text">Total Capital</span>
                    <span class="badge acquisition-date"></span>
                    <span class="badge acquisition-date">{{ $totalPurchaseCosts }}</span>
                  </span>
                </div>
                <footer class="card__footer">
                  <div class="card__divider"></div>
                </footer>
            </div>
        </div>



      </div>

      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

        <div class="scrollable-list">
            <table class="table pps-table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Cash Inflows (Sales) (K)</th>
                        <th scope="col">Cash Outflows (Purchases) (K)</th>
                        <th scope="col">Net Cash Flows (K)</th>
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
                                                <span class="data-name">Cash Inflows (Sales) (K):</span>
                                                {{ $soldCommodity->sold_quantity * $soldCommodity->selling_price }}
                                            </td>
                                            <td>
                                                <span class="data-name">Cash Outflows (Purchases) (K):</span>
                                                {{ $Purchases->quantity * $Purchases->cost_price }}
                                            </td>
                                            <td>
                                                <span class="data-name">Net Cashflows (K):</span>
                                                @if( (($soldCommodity->sold_quantity * $soldCommodity->selling_price) - ($Purchases->quantity * $Purchases->cost_price)) < 0 )
                                                ({{
                                                    (($soldCommodity->sold_quantity * $soldCommodity->selling_price) - ($Purchases->quantity * $Purchases->cost_price)) * -1
                                                }})
                                                @elseif( (($soldCommodity->sold_quantity * $soldCommodity->selling_price) - ($Purchases->quantity * $Purchases->cost_price)) > 0 )
                                                {{
                                                    ($soldCommodity->sold_quantity * $soldCommodity->selling_price) - ($Purchases->quantity * $Purchases->cost_price)
                                                }}
                                                @endif
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
                                                <span class="data-name">Cash Inflows (Sales) (K):</span>
                                                {{ $soldType->selling_price * $soldType->sold_quantity }}
                                            </td>
                                            <td>
                                                <span class="data-name">Cash Outflows (Purchases) (K):</span>
                                                {{ $typePurchase->cost_price * $typePurchase->quantity }}
                                            </td>
                                            <td>
                                                <span class="data-name">Net Cashflows (K):</span>
                                                @if( (($soldType->selling_price * $soldType->sold_quantity) - ($typePurchase->cost_price * $typePurchase->quantity)) < 0 )
                                                ({{
                                                    (($soldType->selling_price * $soldType->sold_quantity) - ($typePurchase->cost_price * $typePurchase->quantity)) * -1
                                                 }})
                                                @elseif( (($soldType->selling_price * $soldType->sold_quantity) - ($typePurchase->cost_price * $typePurchase->quantity)) > 0 )
                                                {{
                                                    ($soldType->selling_price * $soldType->sold_quantity) - ($typePurchase->cost_price * $typePurchase->quantity)
                                                }}
                                                @endif
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
                    <span class="quantity-text">Total Net Cash Flows</span>
                    <span class="badge quantity-value">
                        @if ( ($totalActualSales - $totalPurchaseCosts) < 0 )
                            ({{
                                ($totalActualSales - $totalPurchaseCosts) * -1
                             }})
                        @elseif ( ($totalActualSales - $totalPurchaseCosts) > 0 )
                            {{ $totalActualSales - $totalPurchaseCosts }}
                        @endif
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
