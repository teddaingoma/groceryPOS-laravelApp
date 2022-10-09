@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
    @if (session('status'))
        <div class="alert alert-success text-success">
            {{ session('status') }}
        </div>
    @endif
    <h2 class="pps-main-content-title">Lorem, ipsum dolor.</h2>
  </div>

  <div class="pps-main-content-body">
    <nav class="pps-body-nav">
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Commodities</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
      </div>
    </nav>
    <div class="tab-content pps-body-content" id="nav-tabContent">

      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="pps-commodities">
          <div class="flex flex-col--wrap">
            @forelse ($commodities as $commodity)
                <div class="commodity">
                    <div class="card">
                        <header class="card__header">
                            <div class="commodity__icon">
                                <img class="icon" src="{{ asset('commodity_images/' . $commodity -> image_path) }}" alt="">
                                <h3 class="commodity__name">{{ $commodity -> name }}</h3>
                            </div>
                            <div class="commodity__tags">
                                <span class="commodity__price">
                                    <span class="commodity__currency">MWK</span>
                                    <span class="commodity__amount">
                                        @if ($commodity->Price == '')
                                            <a href="/commodity/{{ $commodity -> id }}/add_commodity_price" role="button" class="btn btn--primary btn--icon">
                                                <span class="icon-container icon--small">
                                                    <img class="icon" src="{{ asset('images/edit-filled.ico') }}" alt="">
                                                </span>
                                                price
                                            </a>
                                        @else
                                            {{ $commodity->Price->price }}
                                        @endif

                                    </span>
                                    <span class="commodity__unit">/
                                        @if ($commodity->Unit == '')
                                            <a href="/commodity/{{ $commodity -> id }}/add_commodity_unit" role="button" class="btn btn--primary btn--icon">
                                                <span class="icon-container icon--small">
                                                    <img class="icon" src="{{ asset('images/edit-filled.ico') }}" alt="">
                                                </span>
                                                unit
                                            </a>
                                        @else
                                            {{ $commodity->Unit -> unit }}
                                        @endif
                                    </span>

                                </span>
                                <span class="commodity__description">{{ $commodity -> description }}</span>
                            </div>
                        </header>
                        <div class="card__body">

                            <span class="commodity__quantity">
                                <span class="quantity-text">Quantity</span>
                                <span class="badge quantity-value">
                                    @if ($commodity->Quantity == '')
                                        <a href="/commodity/{{ $commodity -> id }}/add_commodity_quantity" role="button" class="btn btn--primary btn--icon">
                                            <span class="icon-container icon--small">
                                                <img class="icon" src="{{ asset('images/edit-filled.ico') }}" alt="">
                                            </span>
                                            quantity
                                        </a>
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

                            <span class="commodity__acquisition-date">
                                <span class="acquisition-text">Acquired On</span>
                                <span class="badge acquisition-date">
                                    @if($commodity->AquisitionDate == '')
                                        <a href="/commodity/{{ $commodity -> id }}/add_commodity_aquisition-date" role="button" class="btn btn--primary btn--icon">
                                            <span class="icon-container icon--small">
                                                <img class="icon" src="{{ asset('images/edit-filled.ico') }}" alt="">
                                            </span>
                                            date
                                        </a>
                                    @else
                                        {{ $commodity->AquisitionDate -> aquisition_date }}
                                    @endif
                                </span>
                            </span>

                            <span class="commodity__category">
                                <span class="category-text">Category (s) :</span>
                                @forelse ($commodity -> Categories as $category)
                                    <span class="badge category-value">{{ $category -> name }}</span>
                                @empty
                                    <span class="badge category-value">no categories</span>
                                @endforelse
                                <a href="/commodity/{{ $commodity -> id }}/add_commodity_category" role="button" class="btn btn--primary btn--icon">
                                    <span class="icon-container icon--small">
                                        <img class="icon" src="{{ asset('images/edit-filled.ico') }}" alt="">
                                    </span>
                                </a>
                            </span>

                            <span class="commodity__category">
                                <span class="category-text">Type (s) :</span>
                                @forelse ($commodity -> Types as $Type)
                                    <span class="badge category-value">{{ $Type -> type_name }}</span>
                                @empty
                                    <span class="badge category-value">{{ $commodity -> name }} has no types</span>
                                @endforelse

                            </span>

                        </div>
                        <div class="card__btn">
                            <a href="{{ route('home.show', ['home' => $commodity->id]) }}" class="btn btn--primary btn--img">
                                <span class="btn__text">view</span>
                            </a>
                        </div>
                        <footer class="card__footer">
                            <div class="btn--group">
                                <a href="/home/{{ $commodity -> id }}/edit" class="btn btn--edit btn--icon">
                                    <span class="icon-container icon--small">
                                        <img class="icon" src="{{ URL("images/edit-filled.ico") }}" alt="">
                                    </span>
                                    <span class="btn__text">edit</span>
                                </a>
                                <a href="{{ route('add_commodity_type', ['id' => $commodity->id]) }}" class="btn btn--category btn--icon">
                                    <span class="icon-container icon--small">
                                        <img class="icon" src="{{ URL("images/category-dark.ico") }}" alt="">
                                    </span>
                                    <span class="btn__text">type</span>
                                </a>
                                <a href="{{ route('sell_commodity', ['commodity' => $commodity->id]) }}" class="btn btn--category btn--icon">
                                    <span class="icon-container icon--small">
                                        <img class="icon" src="{{ URL("images/sell-dark.ico") }}" alt="">
                                    </span>
                                    <span class="btn__text">Sell</span>
                                </a>

                                <a href="{{ route('add_commodity_supply', ['id' => $commodity->id]) }}" class="btn btn--category btn--icon">
                                    <span class="icon-container icon--small">
                                        <img class="icon" src="{{ URL("images/sell-dark.ico") }}" alt="">
                                    </span>
                                    <span class="btn__text">Supplier Purchase</span>
                                </a>
                            </div>
                            <div class="card__divider"></div>
                            <div class="btn--group">
                                <button class="btn btn--delete btn--icon btn--outline" data-bs-toggle="modal" data-bs-target="#commodityDeleteModal">
                                    <span class="icon-container icon--small">
                                        <img class="icon" src="{{ URL("images/del-dark.ico") }}" alt="">
                                    </span>
                                    <span class="btn__text">delete</span>
                                </button>

                                <div class="modal fade" id="commodityDeleteModal" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="WarningToDelete" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete {{ $commodity -> name }}</h5>
                                            <span class="btn icon-container" data-bs-dismiss="modal" aria-label="Close">
                                                <img class="icon" src="{{ URL("images/close-dark.ico") }}" alt="">
                                            </span>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="text-danger warning--text">
                                                <span class="icon-container">
                                                <img class="icon" src="{{ URL("images/danger-filled.ico") }}" alt="">
                                                </span>
                                                Are You Sure?
                                            </h5>
                                            <div class="container-fluid">
                                                You are about to delete {{ $commodity -> name }} and all its related content from your inventory!
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="" method="">
                                                <button role="button" type="submit" class="btn">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
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

        <div class="flex flex-col--wrap">

            @forelse ($commodityBudgetedSales as $budgetedSales)
                @forelse ($commodityPurchases as $Purchases)
                    @if($budgetedSales->commodity_id == $Purchases->commodity_id)

                        <div class="commodity">
                            <div class="card">
                                <header class="card__header">
                                    <div class="commodity__icon">
                                        <h3 class="commodity__name">{{ $Purchases->CommodityPurchase->name }}</h3>
                                    </div>

                                </header>
                                <div class="card__body">

                                    <span class="commodity__quantity">
                                        <span class="quantity-text">Budgeted Sales</span>
                                        <span class="badge quantity-value">
                                            {{ $budgetedSales->quantity * $budgetedSales->selling_price }}
                                        </span>
                                    </span>

                                    <span class="commodity__acquisition-date">
                                        <span class="acquisition-text">Cost of Sales</span>
                                        <span class="badge acquisition-date">
                                            {{ $Purchases->quantity * $Purchases->cost_price }}
                                        </span>
                                    </span>

                                    <span class="commodity__acquisition-date">
                                        <span class="acquisition-text">Gross Profit</span>
                                        <span class="badge acquisition-date">
                                            {{
                                                ($budgetedSales->quantity * $budgetedSales->selling_price) - ($Purchases->quantity * $Purchases->cost_price)
                                            }}
                                        </span>
                                    </span>

                                </div>

                                <footer class="card__footer">


                                </footer>
                            </div>
                        </div>

                        @foreach ($typePurchases as $typePurchase)
                            @if ( $typePurchase->commodity_id == $Purchases->CommodityPurchase->id)

                                <div class="commodity">
                                    <div class="card">
                                        <header class="card__header">
                                            <div class="commodity__icon">
                                                <h3 class="commodity__name">{{ $typePurchase->CommodityType->type_name }}</h3>
                                            </div>

                                        </header>
                                        <div class="card__body">

                                            <span class="commodity__acquisition-date">
                                                <span class="acquisition-text">Cost of Sales</span>
                                                <span class="badge acquisition-date">
                                                    {{ $typePurchase->cost_price * $typePurchase->quantity }}
                                                </span>
                                            </span>

                                        </div>

                                        <footer class="card__footer">


                                        </footer>
                                    </div>
                                </div>

                            @endif
                        @endforeach

                    @endif
                @empty
                    No Sales and Purchases
                @endforelse
            @empty
                if ($commodityPurchases == NULL)
                {
                    No Sales and Purchases
                }
            @endforelse
        </div>

        <div class="card">
            <div class="card__body">

                <span class="commodity__quantity">
                    <span class="quantity-text">Total Gross Profit</span>
                    <span class="badge quantity-value">
                        {{ $totalGrossProfit }}
                    </span>
                </span>

            </div>

        </div>

      </div>
      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

        <div class="flex flex-col--wrap">

            @forelse ($soldCommodityItem as $soldCommodity)

                <div class="commodity">
                    <div class="card">
                        <header class="card__header">
                            <div class="commodity__icon">
                                <h3 class="commodity__name">{{ $soldCommodity->SoldCommodity->name }}</h3>
                            </div>

                        </header>
                        <div class="card__body">

                            <span class="commodity__quantity">
                                <span class="quantity-text">Actual Sales</span>
                                <span class="badge quantity-value">
                                    {{ $soldCommodity->sold_quantity * $soldCommodity->selling_price }}
                                </span>
                            </span>

                        </div>

                        <footer class="card__footer">


                        </footer>
                    </div>
                </div>

            @empty
                No sales
            @endforelse
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
    </div>
  </div>

  <footer class="pps-main-content-footer">

    <div class="commodity">
        <div class="card">
            <div class="card__body">
                <span class="commodity__quantity">
                    <span class="quantity-text">Total Gross Profit</span>
                    <span class="badge quantity-value">
                        {{ $totalGrossProfit }}
                    </span>
                </span>
            </div>
        </div>
    </div>

  </footer>

@endsection
