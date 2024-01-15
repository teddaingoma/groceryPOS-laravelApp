@props(['type' => $type, 'commodity' => $commodity])

<div class="commodity">
    <div class="card">
        <header class="card__header">
            <div class="commodity__icon">
                @if ($type->image_path == '')
                    <img class="icon" src="{{ asset('commodity_images/' . $commodity -> image_path) }}" alt="">
                @else
                    <img class="icon" src="{{ asset('commodity_images/' . $type -> image_path) }}" alt="">
                @endif
                <h3 class="commodity__name">{{ $type -> type_name }}</h3>
            </div>
            <div class="commodity__tags">
                <span class="commodity__price">
                    <span class="commodity__currency">MWK</span>
                    <span class="commodity__amount">
                        @if ($type->TypePrice == '')
                            00.00
                        @else
                            {{ $type->TypePrice->type_price }}
                        @endif

                    </span>
                    <span class="commodity__unit">/
                        @if ($commodity->Unit == '')
                            Unit
                        @else
                            {{ $commodity->Unit -> unit }}
                        @endif
                    </span>

                </span>
                <span class="commodity__description">
                    @if($type->description == '')
                        {{ $commodity -> description }}
                    @else
                        {{ $type->description }}
                    @endif
                </span>
            </div>
        </header>
        <div class="card__body">

            <span class="commodity__quantity">
                <span class="quantity-text">Quantity</span>
                <span class="badge quantity-value">
                    @if ($type->TypeQuantity == '')
                        out of stock
                    @else
                        {{ $type->TypeQuantity->type_quantity }}
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
                    @if ($type->TypeAquisitionDate == '')
                        dd-mm-yyyy
                    @else
                        {{ $type->TypeAquisitionDate->type_aquisition_date }}
                    @endif
                </span>
            </span>
        </div>
        <div class="card__btn">
            <a href="{{ route('show_commodity_type', ['commodity' => $commodity->id, 'type' => $type->id]) }}" class="btn btn--primary btn--img">
                <span class="btn__text">view</span>
            </a>
        </div>
    </div>
</div>
