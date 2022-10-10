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
                <h2 class="pps-main-content-title">Add stock of {{ $Type->type_name }} from a supplier</h2>
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
                            <form action="{{ route('store_type_supply', ['commodity' => $Commodity->id, 'type' => $Type->id]) }}" method="POST" enctype="multipart/form-data" novalidate class="add-commodity needs-validation">
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
                                        <div class="row g-3">
                                            <div class="names row g-3">

                                                <div class="col-sm-6 form--input-line">
                                                    <label for="formFile" class="form-label">Name: {{ $Type->type_name }}</label>
                                                </div>

                                            </div>

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

                                    </div>
                                    <footer class="card__footer">
                                         <div class="form--btn-group">
                                            <button class="btn btn--primary" type="reset">Clear</button>
                                            <button class="btn btn--primary" type="submit">Add Commodity</button>
                                        </div>
                                    </footer>
                                </div>
                            </form>
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
