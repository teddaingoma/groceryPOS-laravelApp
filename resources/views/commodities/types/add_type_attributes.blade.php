<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Grocery Portable Point-Of-Sales system for small-scale grocery businesses">
        <meta name="author" content="teddai Ngoma">
        <title>Add Commodity Attribute Types | </title>
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
                <h1 class="form--title">Add Attributes of {{ $commodity -> name}}</h1>
            </div>

            <div class="add-commodity--body">
                <form class="add-commodity needs-validation" action="/commodity/add_commodity_attributes" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form--control-group">

                        <div class="form--control-lead">
                            <img class="control-lead-icon" src="{{ asset('commodity_images/' . $commodity -> image_path) }}" alt="">
                            <h2 class="mb-0 control-lead-text">Commodity Item Details</h2>
                        </div>
                        <input name="commodity_id" type="text" class="form-control" id="firstName" value="{{ $commodity -> id }}" readonly>
                        <div class="row g-3">
                            <div class="names row g-3">

                                <div class="col-sm-6 form--input-line">
                                    <label for="category" class="form-label">Commodity Category:</label>
                                    <select id="category" name="category_id" class="form-select" aria-label="Select Commodity Category" required>
                                        <option selected>Select your commodity category</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                                        @empty
                                            No Categories Yet
                                        @endforelse
                                    </select>
                                    <div class="invalid-feedback">
                                        In what category does it belong?
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-6 form--input-line">
                                <label for="lastName" class="form-label">Cost Price <span class="text-muted">MWK</span>:</label>
                                <input name="cost_price" type="number" class="form-control" id="lastName" placeholder="MWK: 00.00" value="">
                                <div class="invalid-feedback">
                                    Enter the cost price, please.
                                </div>
                            </div>

                            <div class="col-sm-6 form--input-line">
                                <label for="firstName" class="form-label">Quantity:</label>
                                <input name="commodity_quantity" type="number" class="form-control" id="firstName" placeholder="Available quantity" value="">
                                <div class="invalid-feedback">
                                    Enter the available quantity of the Commodity, Please.
                                </div>
                            </div>

                            <div class="col-sm-6 form--input-line">
                                <label for="firstName" class="form-label">Commodity Unit:</label>
                                <input name="commodity_unit" type="text" class="form-control" id="firstName" placeholder="" value="">
                                <div class="invalid-feedback">
                                    Enter the unit of measurement of the commodity, Please.
                                </div>
                            </div>

                            <div class="date">

                                <div class="col-sm-6 form--input-line">
                                    <label for="dob" class="form-label">Date Acquired</label>

                                    <input type="date" name="acquisition_date" class="form-control" id="dob" placeholder="birthday">

                                    <div class="invalid-feedback">
                                        When was the commodity purchased or added?.
                                    </div>
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

        </div>

        @include('layout.main-footer')


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('js/jquery.min.js') }}" ></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>

    </body>
</html>
