@props(['commodity' => $commodity])

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
                    @if ($commodity->Price == '')
                        <span class="commodity__amount empty">
                            price
                            <a href="/commodity/{{ $commodity -> id }}/add_commodity_price" role="button" class="btn btn--icon">
                            <img class="icon" src="{{ asset('images/add-light.ico') }}" alt="">
                            </a>
                        </span>
                    @else
                        <span class="commodity__amount">{{ $commodity->Price->price }}</span>
                    @endif
                    @if ($commodity->Unit == '')
                        <span class="commodity__unit empty">
                            /unit
                            <a href="/commodity/{{ $commodity -> id }}/add_commodity_unit" role="button" class="btn btn--icon">
                            <img class="icon" src="{{ asset('images/add-light.ico') }}" alt="">
                            </a>
                        </span>
                    @else
                        <span class="commodity__unit">/{{ $commodity->Unit -> unit }}</span>

                    @endif
                </span>
                <span class="commodity__description">{{ $commodity -> description }}</span>
            </div>
        </header>
        <div class="card__body">
            <span class="commodity__quantity">
                <span class="quantity-text">Quantity</span>
                <span class="badge quantity-value">
                    @if ($commodity->Quantity == '')
                        empty
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
                @if($commodity->AquisitionDate == '')
                    <span class="badge acquisition-date">
                        date
                    </span>
                    <span class="badge acquisition-date empty">
                        <a href="/commodity/{{ $commodity -> id }}/add_commodity_aquisition-date" role="button" class="btn btn--icon">
                            <img class="icon" src="{{ asset('images/add-dark.ico') }}" alt="">
                        </a>
                    </span>
                @else
                    <span class="badge acquisition-date">{{ $commodity->AquisitionDate -> aquisition_date }}</span>
                @endif
            </span>
        </div>
    </div>
</div>
