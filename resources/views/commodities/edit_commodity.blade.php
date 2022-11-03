<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Grocery Portable Point-Of-Sales system for small-scale grocery businesses">
        <meta name="author" content="teddai Ngoma">
        <title>Edit Commodity Item | {{ $commodity -> name }}</title>
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

        <div class="container-fluid px-0 pps-content">

            <div class="pps-aside">

                <aside class="pps-sidebar-icon">
                    <div class="d-flex flex-column flex-shrink-0 pps-sidebar__nav-icon">
                        <span class="d-block pps-sidebar-icon-title" title="Add Commodity item" data-bs-toggle="tooltip" data-bs-placement="right">
                            <span class="icon-container bi me-2">
                                <img class="icon" src="{{ asset('images/add-commodity-light.ico') }}" alt="">
                            </span>
                          <span class="visually-hidden">AEdit</span>
                        </span>
                        <hr class="pps-sidebar-divider">
                    </div>
                </aside>

                <aside class="pps-sidebar wide-display collapse collapse-horizontal" id="collapseSideMenuBar">
                    <div class="form--header">
                        <img class="form--brand" src="{{ asset('images/add-commodity-light.ico') }}" alt="">
                        <h1 class="form--title">Edit</h1>
                    </div>
                </aside>

            </div>

            <main class="pps-main-content">

                <div class="add-commodity-form scrollable-list">

                    <div class="form--header">
                        <img class="form--brand" src="{{ asset('images/image1.jpg') }}" alt="">
                        <h1 class="form--title">Edit {{ $commodity -> name}}</h1>
                    </div>

                    <div class="add-commodity--body">
                        <form class="add-commodity needs-validation" action="/home/{{ $commodity -> id }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form--control-group">

                                <div class="form--control-lead">
                                    <img class="control-lead-icon" src="{{ asset('commodity_images/' . $commodity -> image_path) }}" alt="">
                                    <h2 class="mb-0 control-lead-text">Commodity Item Details</h2>
                                </div>
                                <input class="no-view" name="commodity_id" type="text" class="form-control" id="firstName" value="{{ $commodity -> id }}" readonly>
                                <div class="row g-3">
                                    <div class="names row g-3">

                                        <div class="col-sm-6 form--input-line">
                                            <label for="firstName" class="form-label">Change Commodity Name:</label>
                                            <input name="commodity_name" type="text" class="form-control" id="firstName" placeholder="{{ $commodity -> name }}" value="{{ $commodity -> name }}" required>
                                            <div class="invalid-feedback">
                                            Enter the Name of the Commodity, Please.
                                            </div>
                                        </div>

                                        <div class="col-sm-6 form--input-line">
                                            <label for="formFile" class="form-label">Change the commodity Image <span class="text-muted">(Optional)</span>:</label>
                                            <input name="commodity_image" type="file" class="form-control" id="formFile" placeholder="" value="{{ asset('commodity_images/' . $commodity -> image_path) }}">
                                            <div class="invalid-feedback">
                                            Provide an image of the commodity.
                                            </div>
                                        </div>


                                    </div>

                                    <div class="form--input-line">
                                        <label for="lastName" class="form-label">Change Description <span class="text-muted">(Optional)</span>:</label>
                                    </div>
                                    <textarea name="commodity_description" class="form-control" id="lastName" placeholder="{{ $commodity -> description  }}" aria-label="textarea" required>
                                        {{ $commodity->description }}
                                    </textarea>
                                    <div class="invalid-feedback">
                                        Describe your commodity in a few words..
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="names row g-3">

                                        <div class="col-sm-6 form--input-line">
                                            <label for="category" class="form-label">Commodity Category:</label>
                                            @forelse ($commodity -> Categories as $category)
                                                <span class="badge category-value">{{ $category -> name }}</span>
                                            @empty
                                                <span class="badge category-value">no categories</span>
                                            @endforelse
                                        </div>

                                        <div class="col-sm-6 form--input-line">
                                            <label for="formFile" class="form-label">Commodity Type<span class="text-muted">(Optional)</span>:</label>
                                            @forelse ($commodity -> Types as $Type)
                                                <span class="badge category-value">{{ $Type -> type_name }}</span>
                                            @empty
                                                <span class="badge category-value">{{ $commodity -> name }} has no types</span>
                                            @endforelse
                                        </div>


                                    </div>

                                    <div class="col-sm-6 form--input-line">
                                        <label for="lastName" class="form-label">Cost Price <span class="text-muted">MWK</span>:</label>
                                        @if ($commodity->Price == '')
                                        00.00
                                        @else
                                            {{ $commodity->Price->price }}
                                        @endif
                                    </div>

                                    <div class="col-sm-6 form--input-line">
                                        <label for="firstName" class="form-label">Quantity:</label>
                                        @if ($commodity->Quantity == '')
                                            Out of Stock
                                        @else
                                            {{ $commodity->Quantity -> quantity }}
                                        @endif
                                    </div>

                                    <div class="col-sm-6 form--input-line">
                                        <label for="firstName" class="form-label">Commodity Unit:</label>
                                        @if ($commodity->Unit == '')
                                            Unit
                                        @else
                                            {{ $commodity->Unit -> unit }}
                                        @endif
                                    </div>

                                    <div class="date">

                                        <div class="col-sm-6 form--input-line">
                                            <label for="dob" class="form-label">Date Acquired</label>

                                            @if($commodity->AquisitionDate == '')
                                                dd-mm-yyyy
                                            @else
                                                {{ $commodity->AquisitionDate -> aquisition_date }}
                                            @endif
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
