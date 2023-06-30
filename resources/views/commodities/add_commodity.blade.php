<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Grocery Portable Point-Of-Sales system for small-scale grocery businesses">
        <meta name="author" content="teddai Ngoma">
        <title>Add Commodity</title>
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
                          <span class="visually-hidden">Add Commodity Item</span>
                        </span>
                        <hr class="pps-sidebar-divider">
                    </div>
                </aside>

                <aside class="pps-sidebar wide-display collapse collapse-horizontal" id="collapseSideMenuBar">
                    <div class="form--header">
                        <img class="form--brand" src="{{ asset('images/add-commodity-light.ico') }}" alt="">
                        <h1 class="form--title">Add a Commodity Item</h1>
                    </div>
                </aside>

            </div>

            <main class="pps-main-content">

                <div class="add-commodity-form scrollable-list">

                    <div class="form--header">
                        <h1 class="form--title">Add a Commodity Item</h1>
                    </div>

                    <div class="add-commodity--body">
                        <form class="add-commodity needs-validation" action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="form--control-group">

                                <div class="form--control-lead">
                                    <img class="control-lead-icon" src="{{ asset('images/item-light.ico') }}" alt="">
                                    <h2 class="mb-0 control-lead-text">Commodity Item Details</h2>
                                </div>

                                <div class="row g-3">
                                    <div class="names row g-3">

                                        <div class="col-sm-6 form--input-line">
                                            <label for="firstName" class="form-label">Commodity Name:</label>
                                            <input name="commodity_name" type="text" class="form-control" id="firstName" placeholder="" value="" required>
                                            <div class="invalid-feedback">
                                            Enter the Name of the Commodity, Please.
                                            </div>
                                        </div>

                                        <div class="col-sm-6 form--input-line">
                                            <label for="formFile" class="form-label">Image <span class="text-muted">(Optional)</span>:</label>
                                            <input name="commodity_image" type="file" class="form-control" id="formFile" placeholder="" value="">
                                            <div class="invalid-feedback">
                                            Provide an image of the commodity.
                                            </div>
                                        </div>


                                    </div>

                                    <div class="form--input-line">
                                    <label for="lastName" class="form-label">Description <span class="text-muted">(Optional)</span>:</label>
                                    </div>
                                    <textarea name="commodity_description" class="form-control" id="lastName" placeholder="describe your commodity item in a few words..." value="" aria-label="textarea" required></textarea>
                                    <div class="invalid-feedback">
                                        describe your commodity item in a few words...
                                    </div>
                                </div>

                            </div>

                            <div class="form--btn-group">
                            <button class="btn btn--primary" type="reset">Clear</button>
                            <button class="btn btn--primary" type="submit">Proceed</button>
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
