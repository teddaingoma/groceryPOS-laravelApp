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
        <footer class="card__footer">
            <div class="btn--group">
                <a href="{{ route('edit_commodity_type', ['commodity' => $commodity->id, 'type' => $type->id]) }}" class="btn btn--edit btn--icon">
                    <span class="icon-container icon--small">
                        <img class="icon" src="{{ URL("images/edit-filled.ico") }}" alt="">
                    </span>
                    <span class="btn__text">edit</span>
                </a>
                <a href="{{ route('sell_type', ['commodity' => $commodity->id, 'type' => $type->id]) }}" class="btn btn--category btn--icon">
                    <span class="icon-container icon--small">
                        <img class="icon" src="{{ URL("images/sell-dark.ico") }}" alt="">
                    </span>
                    <span class="btn__text">Sell</span>
                </a>
                <a href="{{ route('add_type_supply', ['commodity' => $commodity->id, 'type' => $type->id]) }}" class="btn btn--category btn--icon">
                    <span class="icon-container icon--small">
                        <img class="icon" src="{{ URL("images/sell-dark.ico") }}" alt="">
                    </span>
                    <span class="btn__text">Supplier Purchase</span>
                </a>
            </div>
            <div class="card__divider"></div>
            <div class="btn--group">
                <button class="btn btn--delete btn--icon btn--outline" data-bs-toggle="modal" data-bs-target="#DeleteTypeModal_{{ $type->id }}">
                    <span class="icon-container icon--small">
                        <img class="icon" src="{{ URL("images/del-dark.ico") }}" alt="">
                    </span>
                    <span class="btn__text">delete</span>
                </button>

                <div class="modal fade" id="DeleteTypeModal_{{ $type->id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="WarningToDelete" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete {{ $type -> type_name }}</h5>
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
                                You are about to delete {{ $type -> type_name }} and all its related content from your inventory!
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('type.destroy', ['type' => $type->id] ) }}" method="post">
                                @csrf
                                {{--  method spoofing  --}}
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
