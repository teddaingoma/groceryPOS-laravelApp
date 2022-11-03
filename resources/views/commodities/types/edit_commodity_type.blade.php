@extends('layout.app')

@section('content')

    @foreach ($Commodity->Types as $Type )

        @if ($Type->id == $commodity_type_id)

            <div class="pps-main-content-header">
                @if (session('status'))
                    <div class="alert alert-success text-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h2 class="pps-main-content-title">Edit {{ $Type->type_name }}</h2>
            </div>

            <div class="pps-main-content-body">
                <nav class="pps-body-nav">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Commodities</button>

                </div>
                </nav>
                <div class="tab-content pps-body-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="pps-commodities">
                        <div class="commodity">
                            <form action="{{ route('update_commodity_type', ['commodity' => $Commodity->id, 'type' => $Type->id]) }}" method="POST" enctype="multipart/form-data" novalidate class="add-commodity needs-validation">
                                @csrf
                                @method('PUT')
                                <div class="card">
                                    <header class="card__header">
                                        <div class="commodity__icon">
                                            @if ($Type->image_path == '')
                                                <img class="icon" src="{{ asset('commodity_images/' . $Commodity -> image_path) }}" alt="">
                                            @else
                                                <img class="icon" src="{{ asset('commodity_images/' . $Type -> image_path) }}" alt="">
                                            @endif
                                            <h3 class="commodity__name">
                                                {{ $Type -> type_name }}
                                            </h3>
                                        </div>
                                        <div class="commodity__tags">
                                            <span class="commodity__description">
                                                @if($Type->description == '')
                                                    {{ $Commodity -> description }}
                                                @else
                                                    {{ $Type->description }}
                                                @endif
                                            </span>
                                        </div>
                                    </header>
                                    <div class="card__body">
                                        <div class="row g-3">
                                            <div class="names row g-3">

                                                <div class="col-sm-6 form--input-line">
                                                    <label for="formFile" class="form-label">Change Name:</label>
                                                    <input name="commodity_type" type="text" class="form-control" id="formFile" placeholder="{{ $Type->type_name }}" value="{{ $Type->type_name }}">
                                                    <div class="invalid-feedback">
                                                        Provide a type if it has one
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 form--input-line">
                                                    <label for="formFile" class="form-label">Change Image <span class="text-muted">(Optional)</span>:</label>
                                                    <input name="commodity_type_image" type="file" class="form-control" id="formFile" placeholder="" value="{{  asset('commodity_images/' . $Type -> image_path) }}">
                                                    <div class="invalid-feedback">
                                                    Provide an image of the commodity Type.
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="col-sm-6 form--input-line">
                                                <label for="lastName" class="form-label">Change Cost Price <span class="text-muted">MWK</span>:</label>
                                                <input name="type_cost_price" type="number" class="form-control" id="lastName" placeholder="{{ $Type->TypeCostPrice->type_cost_price }}" value="{{ $Type->TypeCostPrice->type_cost_price }}" required>
                                                <div class="invalid-feedback">
                                                    Enter the cost price, please.
                                                </div>
                                            </div>

                                            <div class="col-sm-6 form--input-line">
                                                <label for="lastName" class="form-label">Change Selling Price <span class="text-muted">MWK</span>:</label>
                                                <input name="type_selling_price" type="number" class="form-control" id="lastName" placeholder="{{ $Type->TypePrice->type_price }}" value="{{ $Type->TypePrice->type_price }}" required>
                                                <div class="invalid-feedback">
                                                    Enter the cost price, please.
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form--input-line">
                                            <label for="lastName" class="form-label">Change description <span class="text-muted">(Optional)</span>:</label>
                                        </div>
                                        <textarea name="commodity_type_description" class="form-control" id="lastName" placeholder="describe your commodity type in a few words..." value="{{ $Type->description }}" aria-label="textarea">
                                            {{ $Type->description }}
                                        </textarea>
                                        <div class="invalid-feedback">
                                            Define the type in a few words...
                                        </div>

                                        <div class="date">

                                            <div class="col-sm-6 form--input-line">
                                                <label for="dob" class="form-label">Change Date Acquired</label>

                                                <input type="date" name="type_acquisition_date" class="form-control" id="dob" placeholder="{{ $Type->TypeAquisitionDate->type_aquisition_date }}" value="{{ $Type->TypeAquisitionDate->type_aquisition_date }}">

                                                <div class="invalid-feedback">
                                                    When was the commodity purchased or added?.
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <footer class="card__footer">
                                         <div class="form--btn-group">
                                            <button class="btn btn--primary" type="reset">Clear</button>
                                            <button class="btn btn--primary" type="submit">Add Commodity</button>
                                        </div>
                                    </footer>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <footer class="pps-main-content-footer">
                <p>
                    Edit {{ $Type -> type_name }}
                </p>
            </footer>
        @endif

    @endforeach

@endsection
