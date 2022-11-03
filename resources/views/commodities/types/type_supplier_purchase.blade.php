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
                <h2 class="pps-main-content-title">Add stock of {{ $Type->type_name }} from a supplier</h2>
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
                                    <form action="{{ route('store_type_supply', ['commodity' => $Commodity->id, 'type' => $Type->id]) }}" method="POST" enctype="multipart/form-data" novalidate class="add-commodity sell supplier-purchase needs-validation">
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
                                                    <div class="col-sm-6 form--input-line">
                                                        <label for="formFile" class="form-label">Name: {{ $Type->type_name }}</label>
                                                    </div>

                                                    <div class="names row g-3">

                                                        <div class="col-sm-6 form--input-line">
                                                            <label for="firstName" class="form-label">Supplier Quantity:</label>
                                                            <input name="supplier_type_quantity" type="number" class="form-control" id="firstName" placeholder="Supplier Quantity" required>
                                                            <div class="invalid-feedback">
                                                                Enter the quantity purchased from your supplier, Please.
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 form--input-line">
                                                            <label for="lastName" class="form-label">Cost Price <span class="text-muted">MWK</span>:</label>
                                                            <input name="type_cost_price" type="number" class="form-control" id="lastName" placeholder="MWK: 00.00" required>
                                                            <div class="invalid-feedback">
                                                                Enter the cost price, please.
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 form--input-line">
                                                            <label for="lastName" class="form-label">Selling Price <span class="text-muted">MWK</span>:</label>
                                                            <input name="type_selling_price" type="number" class="form-control" id="lastName" placeholder="MWK: 00.00" required>
                                                            <div class="invalid-feedback">
                                                                Enter the cost price, please.
                                                            </div>
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
                                                    <div class="form--btn-group">
                                                        <button class="btn btn--primary" type="reset">Clear</button>
                                                        <a role="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#commodityPurchaseModal">Proceed</a>

                                                        <div class="modal fade" id="commodityPurchaseModal" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="WarningToDelete" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Purchase {{ $Type -> type_name }}?</h5>
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
                                                                            You are about to Purchase
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
                                                                        <button type="submit" class="btn btn-success">Purchase</button>
                                                                    </div>
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
