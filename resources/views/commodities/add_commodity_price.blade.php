<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Grocery Portable Point-Of-Sales system for small-scale grocery businesses">
        <meta name="author" content="teddai Ngoma">
        <title>{{ $commodity -> name }} | Add Commodity Price</title>
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
                <h1 class="form--title">Add price of {{ $commodity -> name}}</h1>
            </div>

            <div class="add-commodity--body">
                <form class="add-commodity needs-validation" action="{{ route('store_commodity_price') }}" method="POST" enctype="multipart/form-data" novalidate>
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
                                <label for="lastName" class="form-label">Cost Price <span class="text-muted">MWK</span>:</label>
                                <input name="cost_price" type="number" class="form-control" id="lastName" placeholder="MWK: 00.00" value="" required>
                                <div class="invalid-feedback">
                                    Enter the cost price, please.
                                </div>
                            </div>

                            <div class="col-sm-6 form--input-line">
                                <label for="firstName" class="form-label">Quantity:</label>
                                <span class="badge quantity-value">
                                    @forelse ($commodityQuantity as $Quantity)
                                        @if ($commodity -> id == $Quantity -> commodity_id)
                                            {{ $Quantity -> quantity}}
                                        @endif
                                    @empty
                                        Out of Stock
                                    @endforelse
                                </span>
                            </div>

                            <div class="col-sm-6 form--input-line">
                                <label for="firstName" class="form-label">
                                    Commodity Unit:
                                    @foreach ($commodityUnit as $Unit)

                                        @if ($commodity -> id == $Unit -> commodity_id)
                                            {{ $Unit -> unit }}
                                        @endif
                                    @endforeach
                                </label>

                            </div>

                            <div class="date">

                                <div class="col-sm-6 form--input-line">
                                    <label for="dob" class="form-label">Date Acquired</label>

                                    <span class="badge acquisition-date">
                                        @forelse ($aquisitionDates as $AquisitionDate)
                                            @if ($commodity -> id == $AquisitionDate -> commodity_id)
                                                {{ date('d-m-Y', strtotime($AquisitionDate -> aquisition_date)) }}
                                            @endif
                                        @empty
                                            dd-mm-yyyy
                                        @endforelse
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

        </div>

        @include('layout.main-footer')


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('js/jquery.min.js') }}" ></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>

    </body>
</html>
