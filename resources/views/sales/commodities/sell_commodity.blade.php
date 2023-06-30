<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layout.head-tags')
        <title>{{ $Commodity -> name }} | Sell</title>

    </head>

    <body class="add-commodity-body">

        @include('layout.main-header')

        <div class="container-fluid px-0 pps-content">

            <div class="pps-aside">

                <aside class="pps-sidebar-icon">
                    <div class="d-flex flex-column flex-shrink-0 pps-sidebar__nav-icon">
                        <span class="d-block pps-sidebar-icon-title" title="Add Commodity item" data-bs-toggle="tooltip" data-bs-placement="right">
                            <span class="icon-container bi me-2">
                                <img class="icon" src="{{ asset('images/sell-light.ico') }}" alt="">
                            </span>
                          <span class="visually-hidden">sell Commodity Item</span>
                        </span>
                        <hr class="pps-sidebar-divider">
                    </div>
                </aside>

                <aside class="pps-sidebar wide-display collapse collapse-horizontal" id="collapseSideMenuBar">
                    <div class="form--header">
                        <img class="form--brand" src="{{ asset('images/sell-light.ico') }}" alt="">
                        <h1 class="form--title">Sell Commodity Item</h1>
                    </div>
                </aside>

            </div>

            <main class="pps-main-content">

                <div class="pps-main-content-header">
                    <h2 class="pps-main-content-title">Point Of Sale</h2>
                </div>

                <div class="pps-main-content-body">

                    <nav class="pps-body-nav">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Commodity</button>
                    </div>
                    </nav>

                    <div class="tab-content pps-body-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                        <div class="add-commodity-form scrollable-list">
                            <div class="form--header">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <img class="form--brand" src="{{ asset('images/sell-light.ico') }}" alt="">
                                <h1 class="form--title">Sell {{ $Commodity -> name}}</h1>
                            </div>


                            <div class="add-commodity--body">
                                <form class="add-commodity sell needs-validation" action="{{ route('record_sell_commodity') }}" method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <div class="form--control-group">

                                        <div class="form--control-lead">
                                            <img class="control-lead-icon" src="{{ asset('commodity_images/' . $Commodity -> image_path) }}" alt="">
                                            <h2 class="mb-0 control-lead-text text-wrap">Commodity Details</h2>
                                        </div>

                                        <input class="no-view" name="commodity_id" type="text" class="form-control" id="firstName" value="{{ $Commodity -> id }}" readonly>
                                        <span class="d-block">{{ $Commodity -> description }}</span>

                                        <div class="names row g-3">

                                            <div class="col-sm-6 form--input-line">
                                                <label for="firstName" class="form-label">Quantity:</label>
                                                <input name="sell_quantity" type="number" class="form-control" id="firstName" placeholder="Available quantity" value="1" required>
                                                <div class="invalid-feedback">
                                                    How much of {{ $Commodity->name }} are you selling?.
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
                                                <span class="commodity__amount">
                                                    @if ($Commodity->Price == '')
                                                        Please, set the selling price first
                                                    @else
                                                        <label for="lastName" class="form-label">Selling Price</label>
                                                        <input name="selling_price" type="number" class="form-control" id="lastName" placeholder=" MWK: {{ $Commodity->Price->price }}" value="{{ $Commodity->Price->price }}" readonly required>
                                                    @endif

                                                </span>
                                            </div>

                                        </div>

                                        <span class="commodity__quantity">
                                            <span class="quantity-text">Available Quantity</span>
                                            <span class="badge quantity-value">
                                                @if ($Commodity->Quantity == '')
                                                    Out of stock
                                                @else
                                                    {{ $Commodity->Quantity -> quantity }}
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

                                        <div class="col-sm-6 form--input-line">
                                            <label for="customer" class="form-label">Customer <span class="text-muted">(Optional)</span>:</label>
                                            <select id="customer" name="customer_id" class="form-select" aria-label="Select Commodity Category">
                                                <option></option>
                                                @if(auth()->user()->customers()->count())
                                                    @foreach (auth()->user()->customers as $customer)
                                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                @else
                                                    You don't' have any saved customers
                                                @endif
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form--btn-group">
                                        <button class="btn btn--primary" type="reset">Clear</button>
                                        <a role="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#commodityPurchaseModal">Proceed</a>

                                        <div class="modal fade" id="commodityPurchaseModal" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="WarningToDelete" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sell {{ $Commodity -> name }}?</h5>
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
                                                                {{ $Commodity->Unit -> unit }}
                                                            @endif
                                                            of {{ $Commodity->name }}!
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
                                </form>
                            </div>

                        </div>

                    </div>

                    </div>

                </div>

                <footer class="pps-main-content-footer">
                    <p>
                        Sell Commodity
                    </p>
                </footer>

            </main>

        </div>

        @include('layout.main-footer')


        @include('layout.script-tags')

    </body>
</html>
