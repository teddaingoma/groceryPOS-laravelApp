<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Grocery Portable Point-Of-Sales system for small-scale grocery businesses">
        <meta name="author" content="teddai Ngoma">
        <title>{{ $Commodity -> name }} | Sell</title>
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

        <div class="add-commodity-form">

            <div class="form--header">
                <img class="form--brand" src="{{ asset('images/image1.jpg') }}" alt="">
                <h1 class="form--title">Sell {{ $Commodity -> name}}</h1>
            </div>

            <div class="add-commodity--body">
                <form class="add-commodity needs-validation" action="{{ route('record_sell_commodity') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form--control-group">

                        <div class="form--control-lead">
                            <img class="control-lead-icon" src="{{ asset('commodity_images/' . $Commodity -> image_path) }}" alt="">
                            <h2 class="mb-0 control-lead-text">Commodity Item Details</h2>
                        </div>
                        <input name="commodity_id" type="text" class="form-control" id="firstName" value="{{ $Commodity -> id }}" readonly>
                        <span class="d-block">{{ $Commodity -> description }}</span>
                        <div class="row g-3">
                            <div class="names row g-3">

                                <div class="col-sm-6 form--input-line">
                                    <label for="firstName" class="form-label">Quantity:</label>
                                    <input name="sell_quantity" type="number" class="form-control" id="firstName" placeholder="Available quantity" value="1" required>
                                    <div class="invalid-feedback">
                                        How much of {{ $Commodity->name }} are you selling?.
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


                            <div class="col-sm-6 form--input-line">
                                <label for="firstName" class="form-label">Available Quantity:</label>
                                <span class="badge quantity-value">
                                    @if ($Commodity->Quantity == '')
                                        Out of stock
                                    @else
                                        {{ $Commodity->Quantity -> quantity }}
                                    @endif
                                </span>
                            </div>

                            <div class="col-sm-6 form--input-line">
                                <label for="firstName" class="form-label">
                                    Commodity Unit:
                                    @if ($Commodity->Unit == '')
                                        Unit
                                    @else
                                        {{ $Commodity->Unit -> unit }}
                                    @endif
                                </label>
                            </div>

                            <div class="date">

                                <div class="col-sm-6 form--input-line">
                                    <label for="dob" class="form-label">Date Acquired</label>

                                    <span class="badge acquisition-date">
                                        @if($Commodity->AquisitionDate == '')
                                            dd-mm-yyyy
                                        @else
                                            {{ $Commodity->AquisitionDate -> aquisition_date }}
                                        @endif
                                    </span>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="form--btn-group">
                        <button class="btn btn--primary" type="reset">Clear</button>
                        <button class="btn btn--primary" data-bs-toggle="modal" data-bs-target="#commodityDeleteModal">Sell Commodity</button>

                        <div class="modal fade" id="commodityDeleteModal" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="WarningToDelete" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Sell {{ $Commodity -> name }}?</h5>
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
                                       You are about to Sell {{  $Commodity->Unit -> unit }} (s) of {{ $Commodity->name }}!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button role="button" type="submit" class="btn">Sell</button>
                                </div>
                            </div>
                        </div>
                        </div>


                    </div>
                </form>
            </div>

        </div>

        @include('layout.main-footer')


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('js/jquery.min.js') }}" ></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>

    </body>
</html>
