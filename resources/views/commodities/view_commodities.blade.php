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
                                <img class="icon" src="images/image1.jpg" alt="">
                                <h3 class="commodity__name">{{ $commodity -> name }}</h3>
                            </div>
                            <div class="commodity__tags">
                                <span class="commodity__price">
                                    <span class="commodity__currency">MWK</span>
                                    @forelse ($commodityPrice as $Price)
                                        @if ($commodity -> id == $Price -> commodity_id)
                                            {{ $Price -> price }}
                                        @endif
                                    @empty
                                        00.00
                                    @endforelse
                                </span>
                                <span class="commodity__description">{{ $commodity -> description }}</span>
                            </div>
                        </header>
                        <div class="card__body">
                            Quantity:
                            @forelse ($commodityQuantity as $Quantity)
                                @if ($commodity -> id == $Quantity -> commodity_id)
                                    {{ $Quantity -> quantity}}
                                @endif
                            @empty
                                Out of Stock
                            @endforelse
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
