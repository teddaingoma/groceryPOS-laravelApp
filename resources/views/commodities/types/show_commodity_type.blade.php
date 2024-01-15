@extends('layout.app')

@section('content')

    @foreach ($commodity->Types as $type )

        @if ($type->id == $commodity_type_id)

            <div class="pps-main-content-header">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <span class="icon-container icon--circle">
                    @if ($type->image_path == '')
                        <img class="icon" src="{{ asset('commodity_images/' . $commodity -> image_path) }}" alt="">
                    @else
                        <img class="icon" src="{{ asset('commodity_images/' . $type -> image_path) }}" alt="">
                    @endif
                </span>
                <h2 class="pps-main-content-title title-case-lower">{{ $commodity -> name }} Type | {{ $type->type_name }}</h2>
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
                        <x-type :type="$type" :commodity="$commodity" />
                    </div>
                </div>
                </div>
            </div>

            <footer class="pps-main-content-footer">
                <p>
                    @if($type->description == '')
                        {{ $commodity -> description }}
                    @else
                        {{ $type->description }}
                    @endif
                </p>
            </footer>
        @endif

    @endforeach

@endsection
