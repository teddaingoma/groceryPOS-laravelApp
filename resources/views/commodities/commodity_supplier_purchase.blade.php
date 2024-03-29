<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Grocery Portable Point-Of-Sales system for small-scale grocery businesses">
        <meta name="author" content="teddai Ngoma">
        <title>{{ $commodity -> name }} | Supplier Purchase</title>
        <meta name="description" content="Portable POS system">
        <meta property="og:title" content="Portable POS system">
        <meta property="og:description" content="Portable POS system">
        <meta property="og:type" content="website">
        <meta property="og:image" content="http://">
        <meta property="og:url" content="https://grocerypos.netlify.app">

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


        <!-- grocery portable pos icon -->
        <link rel="icon" href="{{ asset('images/logo-dark.ico') }}">
    </head>

    <body class="add-commodity-body">

        @include('layout.main-header')

        {{--  <div class="add-commodity-form">

            <div class="form--header">
                <img class="form--brand" src="{{ asset('images/image1.jpg') }}" alt="">
                <h1 class="form--title">Add Quantity of {{ $commodity -> name}} from a Supplier purchase</h1>
            </div>

            <div class="add-commodity--body">
                <form class="add-commodity needs-validation" action="{{ route('store_commodity_supply') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form--control-group">

                        <div class="form--control-lead">
                            <img class="control-lead-icon" src="{{ asset('commodity_images/' . $commodity -> image_path) }}" alt="">
                            <h2 class="mb-0 control-lead-text">Commodity Item Details</h2>
                        </div>
                        <input name="commodity_id" type="text" class="form-control" id="firstName" value="{{ $commodity -> id }}" readonly>
                        <span class="d-block">{{ $commodity -> description }}</span>
                        <div class="row g-3">
                            <div class="names row g-3">

                                <div class="col-sm-6 form--input-line">
                                    <label for="category" class="form-label">Commodity Category:</label>
                                    @foreach ($commodity -> Categories as $category)
                                        <span class="badge category-value">{{ $category -> name }}</span>
                                    @endforeach
                                </div>

                                <div class="col-sm-6 form--input-line">
                                    <span class="category-text">Type (s) :</span>
                                        @forelse ($commodity -> Types as $Type)
                                            <span class="badge category-value">{{ $Type -> type_name }}</span>
                                        @empty
                                            <span class="badge category-value">{{ $commodity -> name }} has no types</span>
                                        @endforelse
                                    </span>
                                </div>


                            </div>

                            <div class="col-sm-6 form--input-line">
                                <label for="firstName" class="form-label">Supplier Quantity:</label>
                                <input name="supplier_quantity" type="number" class="form-control" id="firstName" placeholder="Supplier quantity" value="" required>
                                <div class="invalid-feedback">
                                    Enter the quantity purchased from your supplier, Please.
                                </div>
                            </div>

                            <div class="col-sm-6 form--input-line">
                                <label for="lastName" class="form-label">Cost Price <span class="text-muted">MWK</span>:</label>
                                @if ($commodity->CostPrice == '')
                                    <input name="cost_price" type="number" class="form-control" id="lastName" placeholder="00.00" value="" required>
                                    <div class="invalid-feedback">
                                        Sorry, Cost Price is required.
                                    </div>
                                @else
                                    <input name="cost_price" type="number" class="form-control" id="lastName" placeholder="{{ $commodity->CostPrice->cost_price }}" value="{{ $commodity->CostPrice->cost_price }}" required>
                                    <div class="invalid-feedback">
                                        Sorry, Cost Price is required.
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 form--input-line">
                                <label for="lastName" class="form-label">Selling Price <span class="text-muted">MWK</span>:</label>
                                @if ($commodity->Price == '')
                                    <input name="selling_price" type="number" class="form-control" id="lastName" placeholder="00.00" value="" required>
                                    <div class="invalid-feedback">
                                        Sorry, selling Price is required.
                                    </div>
                                @else
                                    <input name="selling_price" type="number" class="form-control" id="lastName" placeholder="{{ $commodity->Price->price }}" value="{{ $commodity->Price->price }}" required>
                                    <div class="invalid-feedback">
                                        Sorry, selling Price is required.
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 form--input-line">
                                <label for="firstName" class="form-label">Commodity Unit:</label>
                                <span class="commodity__unit text-dark">
                                    @if ($commodity->Unit == '')
                                        Unit
                                    @else
                                        {{ $commodity->Unit->unit }}
                                    @endif
                                </span>
                            </div>

                            <div class="date">

                                <div class="col-sm-6 form--input-line">
                                    <label for="dob" class="form-label">Date Acquired</label>

                                    <span class="badge acquisition-date">
                                        @if($commodity->AquisitionDate == '')
                                            dd-mm-yyyy
                                        @else
                                            {{ $commodity->AquisitionDate -> aquisition_date }}
                                        @endif
                                    </span>
                                </div>

                            </div>

                            <div class="col-sm-6 form--input-line">

                            </div>

                        </div>

                    </div>

                    <div class="form--btn-group">
                        <button class="btn btn--primary" type="reset">Clear</button>
                        <button class="btn btn--primary" type="submit">Add Commodity</button>
                    </div>
                </form>
            </div>

        </div>  --}}

        <div class="container-fluid px-0 pps-content">

            <div class="pps-aside">

                <aside class="pps-sidebar-icon">
                    <div class="d-flex flex-column flex-shrink-0 pps-sidebar__nav-icon">
                        <span class="d-block pps-sidebar-icon-title" title="Add Commodity item" data-bs-toggle="tooltip" data-bs-placement="right">
                            <span class="icon-container bi me-2">
                                <img class="icon" src="{{ asset('images/sell-light.ico') }}" alt="">
                            </span>
                          <span class="visually-hidden">Purchase from SUpplier</span>
                        </span>
                        <hr class="pps-sidebar-divider">
                    </div>
                </aside>

                <aside class="pps-sidebar wide-display collapse collapse-horizontal" id="collapseSideMenuBar">
                    <div class="form--header">
                        <img class="form--brand" src="{{ asset('images/sell-light.ico') }}" alt="">
                        <h1 class="form--title">Purchase from Supplier</h1>
                    </div>
                </aside>

            </div>

            <main class="pps-main-content">

              <div class="pps-main-content-header">
                <h2 class="pps-main-content-title">Supplier Purchase | Restock</h2>
              </div>

              <div class="pps-main-content-body">

                <nav class="pps-body-nav">
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Commodities</button>

                  </div>
                </nav>

                <div class="tab-content pps-body-content" id="nav-tabContent">

                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <div class="add-commodity-form scrollable-list">
                        <div class="form--header">
                            <img class="form--brand" src="{{ asset('images/image1.jpg') }}" alt="">
                            <h1 class="form--title">Add Quantity of {{ $commodity -> name}} from a Supplier purchase</h1>
                        </div>


                        <div class="add-commodity--body">
                            <form class="add-commodity sell supplier-purchase needs-validation" action="{{ route('store_commodity_supply') }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="form--control-group">

                                    <div class="form--control-lead">
                                        <img class="control-lead-icon" src="{{ asset('commodity_images/' . $commodity -> image_path) }}" alt="">
                                        <h2 class="mb-0 control-lead-text">Commodity Item Details</h2>
                                    </div>

                                    <input class="no-view" name="commodity_id" type="text" class="form-control" id="firstName"  value="{{ $commodity -> id }}" readonly>
                                    <span class="d-block">{{ $commodity -> description }}</span>

                                    <div class="names row g-3">

                                        <div class="col-sm-6 form--input-line">
                                            <label for="firstName" class="form-label">Supplier Quantity:</label>
                                            <input name="supplier_quantity" type="number" class="form-control" id="firstName" placeholder="Supplier quantity" value="" required>
                                            <div class="invalid-feedback">
                                                Enter the quantity purchased from your supplier, Please.
                                            </div>
                                        </div>

                                        <div class="col-sm-6 form--input-line">
                                            <label for="lastName" class="form-label">Cost Price <span class="text-muted">MWK</span>:</label>
                                            @if ($commodity->CostPrice == '')
                                                <input name="cost_price" type="number" class="form-control" id="lastName" placeholder="00.00" value="" required>
                                                <div class="invalid-feedback">
                                                    Sorry, Cost Price is required.
                                                </div>
                                            @else
                                                <input name="cost_price" type="number" class="form-control" id="lastName" placeholder="{{ $commodity->CostPrice->cost_price }}" value="{{ $commodity->CostPrice->cost_price }}" required>
                                                <div class="invalid-feedback">
                                                    Sorry, Cost Price is required.
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-sm-6 form--input-line">
                                            <label for="lastName" class="form-label">Selling Price <span class="text-muted">MWK</span>:</label>
                                            @if ($commodity->Price == '')
                                                <input name="selling_price" type="number" class="form-control" id="lastName" placeholder="00.00" value="" required>
                                                <div class="invalid-feedback">
                                                    Sorry, selling Price is required.
                                                </div>
                                            @else
                                                <input name="selling_price" type="number" class="form-control" id="lastName" placeholder="{{ $commodity->Price->price }}" value="{{ $commodity->Price->price }}" required>
                                                <div class="invalid-feedback">
                                                    Sorry, selling Price is required.
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-sm-6 form--input-line">
                                            <label for="supplier" class="form-label">Supplier <span class="text-muted">(Optional)</span>:</label>
                                            <select id="supplier" name="supplier_id" class="form-select" aria-label="Select Commodity Category">
                                                <option></option>
                                                @if(auth()->user()->suppliers() !== null)
                                                    @foreach (auth()->user()->suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                    @endforeach
                                                @else
                                                    You don't' have any saved suppliers
                                                @endif
                                            </select>
                                        </div>

                                    </div>

                                    <span class="commodity__quantity">
                                        <span class="quantity-text">Available Quantity</span>
                                        <span class="badge quantity-value">
                                            @if ($commodity->Quantity == '')
                                                Out of stock
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

                                </div>

                                <div class="form--btn-group">
                                  <button class="btn btn--primary" type="reset">Clear</button>
                                  <a role="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#commodityPurchaseModal">Proceed</a>

                                  <div class="modal fade" id="commodityPurchaseModal" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="WarningToDelete" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Purchase {{ $commodity->name }}?</h5>
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
                                                        @if ($commodity->Unit == '')
                                                            Unit (s)
                                                        @else
                                                            {{ $commodity->Unit -> unit }}
                                                        @endif
                                                        of {{ $commodity->name }}!
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
                            </form>
                        </div>

                    </div>

                  </div>

                </div>

              </div>

              <footer class="pps-main-content-footer">
                <p>
                    Supplier Purchase
                </p>
              </footer>

            </main>

        </div>

        @include('layout.main-footer')


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('js/jquery.min.js') }}" ></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>

    </body>
</html>
