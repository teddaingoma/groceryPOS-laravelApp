@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
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
                                <img class="icon" src="{{ URL("images/item-light.ico") }}" alt="">
                                <h3 class="commodity__name">{{ $commodity -> name }}</h3>
                            </div>
                            <div class="commodity__tags">
                                <span class="commodity__price">
                                    <span class="commodity__currency">MWK</span>
                                    <span class="commodity__amount">
                                        @forelse ($commodityPrice as $Price)
                                            @if ($commodity -> id == $Price -> commodity_id)
                                                {{ $Price -> price }}
                                            @endif
                                        @empty
                                            00.00
                                        @endforelse
                                    </span>
                                    <span class="commodity__unit">/
                                        @forelse ($commodityUnit as $Unit)

                                            @if ($commodity -> id == $Unit -> commodity_id)
                                                {{ $Unit -> unit }}
                                            @endif

                                        @empty
                                            Unit
                                        @endforelse
                                    </span>

                                </span>
                                <span class="commodity__description">{{ $commodity -> description }}</span>
                            </div>
                        </header>
                        <div class="card__body">

                            <span class="commodity__quantity">
                                <span class="quantity-text">Quantity</span>
                                <span class="badge quantity-value">
                                    @forelse ($commodityQuantity as $Quantity)
                                        @if ($commodity -> id == $Quantity -> commodity_id)
                                            {{ $Quantity -> quantity}}
                                        @endif
                                    @empty
                                        Out of Stock
                                    @endforelse
                                </span>
                                <span class="commodity__unit">
                                    @forelse ($commodityUnit as $Unit)

                                        @if ($commodity -> id == $Unit -> commodity_id)
                                            {{ $Unit -> unit }}
                                        @endif

                                    @empty
                                        Unit
                                    @endforelse
                                </span>
                            </span>

                            <span class="commodity__acquisition-date">
                                <span class="acquisition-text">Acquired On</span>
                                <span class="badge acquisition-date">
                                    @forelse ($aquisitionDates as $AquisitionDate)
                                        @if ($commodity -> id == $AquisitionDate -> commodity_id)
                                            {{ date('d-m-Y', strtotime($AquisitionDate -> aquisition_date)) }}
                                        @endif
                                    @empty
                                        dd-mm-yyyy
                                    @endforelse
                                </span>
                            </span>

                            <span class="commodity__category">
                                <span class="category-text">Category (s) :</span>
                                @foreach ($commodity -> Categories as $category)
                                    <span class="badge category-value">{{ $category -> name }}</span>
                                @endforeach
                            </span>

                        </div>
                        <div class="card__btn">
                            <button class="btn btn--primary btn--img">
                                <span class="btn__text">view</span>
                            </button>
                        </div>
                        <footer class="card__footer">
                            <div class="btn--group">
                            <button class="btn btn--edit btn--icon">
                                <span class="icon-container icon--small">
                                    <img class="icon" src="{{ URL("images/edit-filled.ico") }}" alt="">
                                </span>
                                <span class="btn__text">edit</span>
                            </button>
                            <button class="btn btn--category btn--icon">
                                <span class="icon-container icon--small">
                                    <img class="icon" src="{{ URL("images/category-dark.ico") }}" alt="">
                                </span>
                                <span class="btn__text">category</span>
                            </button>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Sugar</h5>
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
                                                You are about to delete Sugar and all its related content from your inventory!
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
        <p><strong>This is some placeholder content the Profile tab's associated content.</strong> Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
      </div>
      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        <p><strong>This is some placeholder content the Contact tab's associated content.</strong> Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
      </div>
    </div>
  </div>

  <footer class="pps-main-content-footer">
    <p>
      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta culpa adipisci consequuntur incidunt sint quae minima totam non aliquid sapiente?
    </p>
  </footer>

@endsection
