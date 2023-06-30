@props(['type' => $type, 'commodity' => $commodity])

<div class="commodity">
    <div class="card">
        <header class="card__header">
            <div class="commodity__icon">
                <h3 class="commodity__name">{{ $type -> type_name }}</h3>
            </div>
            <div class="commodity__tags">
                <span class="commodity__price">
                    <span class="commodity__currency">MWK</span>
                    <span class="commodity__amount">
                        @if ($type->TypePrice == '')
                            @if ($commodity->Price == '')
                                00.00
                            @else
                                {{ $commodity->Price->price }}
                            @endif
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
            </div>
        </header>
        <div class="card__body">

            <span class="commodity__quantity">
                <span class="quantity-text">Available Quantity</span>
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

        </div>
        <div class="card__btn">
            <a href="{{ route('sell_type', ['commodity' => $commodity->id, 'type' => $type->id]) }}" class="btn btn--category btn--icon">
                <span class="icon-container icon--small">
                    <img class="icon" src="{{ URL("images/sell-dark.ico") }}" alt="">
                </span>
                <span class="btn__text">Sell</span>
            </a>
        </div>
        <footer class="card__footer">
        </footer>
    </div>
</div>
