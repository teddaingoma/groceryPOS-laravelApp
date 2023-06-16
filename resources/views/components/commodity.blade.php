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
            <span class="commodity__category">
                <span class="category-text">Category (s) :</span>
                <a href="/commodity/{{ $commodity -> id }}/add_commodity_category" role="button">
                    <img class="icon" src="{{asset('images/add-dark.ico')}}" alt="">
                </a>
                <div class="category-values">
                    @forelse ($commodity -> Categories as $category)
                        <span class="badge category-value">{{ $category -> name }}</span>
                    @empty
                        <span class="badge category-value">no categories</span>
                    @endforelse
                </div>
            </span>
            <span class="commodity__type">
                <span class="type-text">Type (s) :</span>
                <div class="type-values">
                    @forelse ($commodity -> Types as $Type)
                        <a href="{{ route('show_commodity_type', ['commodity' => $commodity->id, 'type' => $Type->id]) }}" class="link">
                            <span class="badge type-value">{{ $Type -> type_name }}</span>
                        </a>
                    @empty
                        <span class="badge type-value">{{ $commodity -> name }} has no types</span>
                    @endforelse
                </div>
            </span>
        </div>
        <div class="card__btn">
            <a href="{{ route('home.show', $commodity->id) }}" class="btn btn--primary btn--img">
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
                        <img class="icon" src="{{ asset('images/del-dark.ico') }}" alt="">
                    </span>
                    <span class="btn__text">delete</span>
                </button>

                <div class="modal fade" id="commodityDeleteModal" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="WarningToDelete" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete {{ $commodity -> name }}</h5>
                            <span class="btn icon-container" data-bs-dismiss="modal" aria-label="Close">
                                <img class="icon" src="{{ asset('images/close-dark.ico') }}" alt="">
                            </span>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-danger warning--text">
                                <span class="icon-container">
                                <img class="icon" src="{{ asset('images/danger-filled.ico') }}" alt="">
                                </span>
                                Are You Sure?
                            </h5>
                            <div class="container-fluid">
                                You are about to delete {{ $commodity -> name }} and all its related content from your inventory!
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('home.destroy', ['home' => $commodity->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
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
