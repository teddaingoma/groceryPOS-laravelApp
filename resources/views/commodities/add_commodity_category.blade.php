<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layout.head-tags')
        <title>{{ $commodity -> name }} | Add Commodity Category</title>
    </head>

    <body class="add-commodity-body">

        @include('layout.main-header')

        <main class="pps-main-content">

            <div class="add-commodity-form">

                <div class="form--header">
                    <img class="form--brand" src="{{ asset('images/image1.jpg') }}" alt="">
                    <h1 class="form--title">Add Category of {{ $commodity -> name}}</h1>
                </div>

                <div class="add-commodity--body">
                    <form class="add-commodity needs-validation" action="{{ route('store_commodity_category') }}" method="POST" enctype="multipart/form-data" novalidate>
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
                                        <select id="category" name="category_id" class="form-select" aria-label="Select Commodity Category" required>
                                            <option selected>Select your commodity category</option>
                                            @forelse ($categories as $category)
                                                <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                                            @empty
                                                <option>No Categories Yet</option>
                                            @endforelse
                                        </select>
                                        <div class="invalid-feedback">
                                            In what category does it belong?
                                        </div>
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
                                    <label for="lastName" class="form-label">Cost Price
                                        <span class="text-muted">
                                            MWK
                                            @foreach ($commodityPrice as $Price)
                                                @if ($commodity -> id == $Price -> commodity_id)
                                                    {{ $Price -> price }}
                                                @endif
                                            @endforeach
                                        </span>
                                    </label>
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

        </main>

        @include('layout.main-footer')


        @include('layout.script-tags')

    </body>
</html>
