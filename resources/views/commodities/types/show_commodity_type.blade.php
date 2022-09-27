@extends('layout.app')

@section('content')

    @foreach ($Commodity->Types as $Type )

        @if ($Type->id == $commodity_type_id)

            <div class="pps-main-content-header">
                @if (session('status'))
                    <div class="alert alert-success text-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h2 class="pps-main-content-title">{{ $Commodity -> name }} Type | {{ $Type->type_name }}</h2>
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
                        <div class="commodity">
                            <div class="card">
                                <header class="card__header">
                                    <div class="commodity__icon">
                                        @if ($Type->image_path == '')
                                            <img class="icon" src="{{ asset('commodity_images/' . $Commodity -> image_path) }}" alt="">
                                        @else
                                            <img class="icon" src="{{ asset('commodity_images/' . $Type -> image_path) }}" alt="">
                                        @endif
                                        <h3 class="commodity__name">{{ $Type -> type_name }}</h3>
                                    </div>
                                    <div class="commodity__tags">
                                        <span class="commodity__price">
                                            <span class="commodity__currency">MWK</span>
                                            <span class="commodity__amount">
                                                @if ($Type->TypePrice == '')
                                                    00.00
                                                @else
                                                    {{ $Type->TypePrice->type_price }}
                                                @endif

                                            </span>
                                            <span class="commodity__unit">/
                                                @if ($Commodity->Unit == '')
                                                    Unit
                                                @else
                                                    {{ $Commodity->Unit -> unit }}
                                                @endif
                                            </span>

                                        </span>
                                        <span class="commodity__description">
                                            @if($Type->description == '')
                                                {{ $Commodity -> description }}
                                            @else
                                                {{ $Type->description }}
                                            @endif
                                        </span>
                                    </div>
                                </header>
                                <div class="card__body">

                                    <span class="commodity__quantity">
                                        <span class="quantity-text">Quantity</span>
                                        <span class="badge quantity-value">
                                            @if ($Type->TypeQuantity == '')
                                                out of stock
                                            @else
                                                {{ $Type->TypeQuantity->type_quantity }}
                                            @endif
                                        </span>
                                        <span class="commodity__unit">
                                            @if ($Commodity->Unit == '')
                                                Unit
                                            @else
                                                {{ $Commodity->Unit -> unit }}
                                            @endif
                                        </span>
                                    </span>

                                    <span class="commodity__acquisition-date">
                                        <span class="acquisition-text">Acquired On</span>
                                        <span class="badge acquisition-date">
                                            @if ($Type->TypeAquisitionDate == '')
                                                dd-mm-yyyy
                                            @else
                                                {{ $Type->TypeAquisitionDate->type_aquisition_date }}
                                            @endif
                                        </span>
                                    </span>
                                </div>
                                <footer class="card__footer">
                                    <div class="btn--group">
                                    <a href="/home/{{ $Commodity -> id }}/edit" class="btn btn--edit btn--icon">
                                        <span class="icon-container icon--small">
                                            <img class="icon" src="{{ URL("images/edit-filled.ico") }}" alt="">
                                        </span>
                                        <span class="btn__text">edit</span>
                                    </a>
                                    <a href="{{ route('add_commodity_type', ['id' => $Commodity->id]) }}" class="btn btn--category btn--icon">
                                        <span class="icon-container icon--small">
                                            <img class="icon" src="{{ URL("images/category-dark.ico") }}" alt="">
                                        </span>
                                        <span class="btn__text">type</span>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete {{ $Commodity -> name }}</h5>
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
                                                        You are about to delete {{ $Commodity -> name }} and all its related content from your inventory!
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
        @endif

    @endforeach

@endsection
