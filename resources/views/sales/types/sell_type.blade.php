@extends('layout.app')

@section('content')

    @foreach ($Commodity->Types as $Type )

        @if ($Type->id == $commodity_type_id)

            <div class="pps-main-content-header">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h2 class="pps-main-content-title">Point Of Sale {{ $Type->type_name }}</h2>
            </div>

            <div class="pps-main-content-body">
                <nav class="pps-body-nav">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Commodities</button>

                </div>
                </nav>
                <div class="tab-content pps-body-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="pps-commodities">
                        <div class="commodity">
                            <div class="add-commodity-form scrollable-list">
                                <div class="add-commodity--body">
                                    <form action="{{ route('record_sell_type', ['commodity' => $Commodity->id, 'type' => $Type->id]) }}" method="POST" enctype="multipart/form-data" novalidate class="add-commodity sell needs-validation">
                                        @csrf
                                        <div class="card">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    @if ($Type->image_path == '')
                                                        <img class="icon" src="{{ asset('commodity_images/' . $Commodity -> image_path) }}" alt="">
                                                    @else
                                                        <img class="icon" src="{{ asset('commodity_images/' . $Type -> image_path) }}" alt="">
                                                    @endif
                                                    <h3 class="commodity__name">
                                                        {{ $Type -> type_name }}
                                                    </h3>
                                                </div>
                                                <div class="commodity__tags">
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
                                                <div class="form--control-group">
                                                    <div class="names row g-3">

                                                        <div class="col-sm-6 form--input-line">
                                                            <label for="firstName" class="form-label">Quantity:</label>
                                                            <input name="sell_quantity" type="number" class="form-control" id="firstName" placeholder="Available quantity" value="1" required>
                                                            <div class="invalid-feedback">
                                                                How much of {{ $Type->type_name }} are you selling?.
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 form--input-line">
                                                            <label for="firstName" class="form-label">Payment Amount:</label>
                                                            <input name="paid_amount" type="number" class="form-control" id="firstName" placeholder="Amount Paid" required>
                                                            <div class="invalid-feedback">
                                                                How much has been paid?.
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 form--input-line">
                                                            <label for="lastName" class="form-label">Selling Price <span class="text-muted">MWK</span>:
                                                                @if ($Type->TypePrice == '')
                                                                    0.0
                                                                    <input name="selling_price" class="no-view form-control" required>
                                                                    <div class="invalid-feedback">
                                                                        Please, set the selling Price First
                                                                    </div>
                                                                @else
                                                                    {{ $Type->TypePrice->type_price }}
                                                                @endif
                                                            </label>
                                                        </div>

                                                    </div>

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


                                                </div>

                                            </div>
                                            <footer class="card__footer">
                                                <div class="form--btn-group">
                                                    <button class="btn btn--primary" type="reset">Clear</button>
                                                    <a role="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#commodityPurchaseModal">Proceed</a>

                                                    <div class="modal fade" id="commodityPurchaseModal" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="WarningToDelete" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Sell {{ $Type -> type_name }}?</h5>
                                                                    <buttom class="btn icon-container" data-bs-dismiss="modal" aria-label="Close">
                                                                        <img class="icon" src="{{ asset('images/close-dark.ico') }}" alt="">
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="text-danger warning--text">
                                                                        <span class="icon-container">
                                                                        <img class="icon" src="{{ asset('images/danger-filled.ico') }}" alt="">
                                                                        </span>
                                                                        Are You Sure?
                                                                    </h5>
                                                                    <div class="container-fluid">
                                                                        You are about to Sell
                                                                        @if ($Commodity->Unit == '')
                                                                            Unit (s)
                                                                        @else
                                                                            {{ $Commodity->Unit -> unit }} (s)
                                                                        @endif
                                                                        of {{ $Type->type_name }}!
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success">Sell</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </footer>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
