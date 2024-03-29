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
                <h2 class="pps-main-content-title">Add attributes | {{ $Type->type_name }}</h2>
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
                                    </header>
                                    <div class="card__body">

                                        <div class="add-commodity-form">

                                            <div class="add-commodity--body scrollable-list">
                                                <form class="add-commodity needs-validation" action="{{ route('store_type_attributes', ['commodity' => $Commodity->id]) }}" method="POST" enctype="multipart/form-data" novalidate>
                                                    @csrf
                                                    <div class="form--control-group">

                                                        <div class="form--control-lead">

                                                            @if ($Type->image_path == '')
                                                                <img class="icon" src="{{ asset('commodity_images/' . $Commodity -> image_path) }}" alt="">
                                                            @else
                                                                <img class="icon" src="{{ asset('commodity_images/' . $Type -> image_path) }}" alt="">
                                                            @endif

                                                            <h2 class="mb-0 control-lead-text">Commodity Details of {{ $Type->type_name }}</h2>
                                                        </div>
                                                        <input class="no-view" name="commodity_type_id" type="text" class="form-control" id="firstName" value="{{ $Type -> id }}" readonly>
                                                        <div class="row g-3">
                                                            <div class="names row g-3">

                                                                <div class="col-sm-6 form--input-line">
                                                                    <label for="firstName" class="form-label">Quantity:</label>
                                                                    <input name="type_quantity" type="number" class="form-control" id="firstName" placeholder="Available quantity" required>
                                                                    <div class="invalid-feedback">
                                                                        Enter the available quantity of the Commodity, Please.
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

                                                                <div class="date">

                                                                    <div class="col-sm-6 form--input-line">
                                                                        <label for="dob" class="form-label">Date Acquired</label>

                                                                        <input type="date" name="type_acquisition_date" class="form-control" id="dob" placeholder="echo(date('Y'))">

                                                                        <div class="invalid-feedback">
                                                                            When was the commodity purchased or added?.
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="form--btn-group">
                                                        <button class="btn btn--primary" type="reset">Clear</button>
                                                        <button class="btn btn--primary" type="submit">Add Commodity</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="pps-main-content-footer">
                <p>
                    Add Type Attributes
                </p>
            </footer>
        @endif

    @endforeach

@endsection
