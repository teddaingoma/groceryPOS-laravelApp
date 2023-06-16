<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Commodity Attributes</title>
        @include('layout.head-tags')

    </head>

    <body class="add-commodity-body">

        @include('layout.main-header')

        <div class="container-fluid px-0 pps-content">

            <div class="pps-aside">

                <aside class="pps-sidebar-icon">
                    <div class="d-flex flex-column flex-shrink-0 pps-sidebar__nav-icon">
                        <span class="d-block pps-sidebar-icon-title" title="Add Commodity item" data-bs-toggle="tooltip" data-bs-placement="right">
                            <span class="icon-container bi me-2">
                                <img class="icon" src="{{ asset('images/add-commodity-light.ico') }}" alt="">
                            </span>
                          <span class="visually-hidden">Add Commodity Attributes</span>
                        </span>
                        <hr class="pps-sidebar-divider">
                    </div>
                </aside>

                <aside class="pps-sidebar wide-display collapse collapse-horizontal" id="collapseSideMenuBar">
                    <div class="form--header">
                        <img class="form--brand" src="{{ asset('images/add-commodity-light.ico') }}" alt="">
                        <h1 class="form--title">Add a Commodity Attributes</h1>
                    </div>
                </aside>

            </div>

            <main class="pps-main-content">

                <div class="add-commodity-form scrollable-list">

                    <div class="form--header">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <h1 class="form--title">Add Attributes of {{ $commodity -> name}}</h1>
                    </div>

                    <div class="add-commodity--body">
                        <form class="add-commodity needs-validation" action="{{ route('store_commodity_attributes') }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="form--control-group">

                                <div class="form--control-lead">
                                    <img class="control-lead-icon" src="{{ asset('commodity_images/' . $commodity -> image_path) }}" alt="">
                                    <h2 class="mb-0 control-lead-text">Commodity Item Details</h2>
                                </div>
                                <input class="no-view" name="commodity_id" type="text" class="form-control" id="firstName" value="{{ $commodity -> id }}" readonly>
                                <div class="row g-3">
                                    <div class="names row">

                                        <div class="col-sm-6 form--input-line">
                                            <label for="category" class="form-label">Commodity Category:</label>
                                            <select id="category" name="category_id" class="form-select" aria-label="Select Commodity Category" required>
                                                <option></option>
                                                @if(auth()->user()->categories()->count())
                                                    @foreach (auth()->user()->categories as $category)
                                                        <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                                                    @endforeach
                                                @else
                                                    No Categories Yet
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">
                                                In what category does it belong?
                                            </div>
                                        </div>
                                        <span class="col-sm-6 badge d-flex">
                                            <a href="{{ route('category.create') }}" role="button" class="btn btn--icon">
                                                <img class="icon" src="{{ asset('images/add-dark.ico') }}" alt="">
                                            </a>
                                        </span>

                                    </div>

                                    <div class="col-sm-6 form--input-line">
                                        <label for="lastName" class="form-label">Cost Price <span class="text-muted">MWK</span>:</label>
                                        <input name="cost_price" type="number" class="form-control" id="lastName" placeholder="MWK: 00.00" value="" required>
                                        <div class="invalid-feedback">
                                            Enter the cost price, please.
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form--input-line">
                                        <label for="lastName" class="form-label">Selling Price <span class="text-muted">MWK</span>:</label>
                                        <input name="selling_price" type="number" class="form-control" id="lastName" placeholder="MWK: 00.00" value="" required>
                                        <div class="invalid-feedback">
                                            Enter the cost price, please.
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form--input-line">
                                        <label for="firstName" class="form-label">Quantity:</label>
                                        <input name="commodity_quantity" type="number" class="form-control" id="firstName" placeholder="Available quantity" value="" required>
                                        <div class="invalid-feedback">
                                            Enter the available quantity of the Commodity, Please.
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form--input-line">
                                        <label for="firstName" class="form-label">Commodity Unit:</label>
                                        <input name="commodity_unit" type="text" class="form-control" id="firstName" placeholder="" value="" required>
                                        <div class="invalid-feedback">
                                            Enter the unit of measurement of the commodity, Please.
                                        </div>
                                    </div>

                                    <div class="date">

                                        <div class="col-sm-6 form--input-line">
                                            <label for="dob" class="form-label">Date Acquired</label>

                                            <input type="date" name="acquisition_date" class="form-control" id="dob" placeholder="birthday" required>

                                            <div class="invalid-feedback">
                                                When was the commodity purchased or added?.
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
