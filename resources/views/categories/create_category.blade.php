<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layout.head-tags')
        <title> Category | create </title>
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
                          <span class="visually-hidden">Add a Category</span>
                        </span>
                        <hr class="pps-sidebar-divider">
                    </div>
                </aside>

                <aside class="pps-sidebar wide-display collapse collapse-horizontal" id="collapseSideMenuBar">
                    <div class="form--header">
                        <img class="form--brand" src="{{ asset('images/add-commodity-light.ico') }}" alt="">
                        <h1 class="form--title">Add a Category</h1>
                    </div>
                </aside>

            </div>

            <main class="pps-main-content">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="add-commodity-form scrollable-list">

                    <div class="form--header">
                        <h1 class="form--title">Add a Category</h1>
                    </div>

                    <div class="add-commodity--body">
                        <form class="add-commodity needs-validation" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="form--control-group">

                                <div class="form--control-lead">
                                    <img class="control-lead-icon" src="{{ asset('images/item-light.ico') }}" alt="">
                                    <h2 class="mb-0 control-lead-text">Category details</h2>
                                </div>

                                <div class="row g-3">
                                    <div class="names row g-3">

                                        <div class="col-sm-6 form--input-line">
                                            <label for="Name" class="form-label">Category Name:</label>
                                            <input name="category_name" type="text" class="form-control" id="Name" placeholder="name..." value="" required>
                                            <div class="invalid-feedback">
                                                Enter the Name of the Category, Please.
                                            </div>
                                        </div>

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


        @include('layout.script-tags')

    </body>
</html>
