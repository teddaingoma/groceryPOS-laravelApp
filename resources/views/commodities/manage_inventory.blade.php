<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            Manage Inventory | {{ $commodity->name }}
        </title>
        @include('layout.head-tags')
    </head>
    <body>
        @include('layout.main-header')

        @include('layout.menu-bar-toggler')

        <div class="container-fluid px-0 pps-content">

            <div class="pps-aside">
                @include('layout.main-sidebar')
                @include('layout.main-sidebar-wide')
                @include('layout.main-icon-sidebar')
            </div>

            <main class="pps-main-content">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="pps-main-content-header">
                    <span class="icon-container icon--circle">
                        <img class="icon" src="{{ asset('commodity_images/' . $commodity -> image_path) }}" alt="">
                    </span>
                    <h2 class="pps-main-content-title title-case-lower">

                       {{ $commodity->name }} | Manage

                    </h2>
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

                                    <div class="card">
                                        <header class="card__header">
                                            <div class="commodity__icon">
                                                <img class="icon" src="{{ asset('commodity_images/' . $commodity -> image_path) }}" alt="">
                                                <h3 class="commodity__name">{{ $commodity -> name }}</h3>
                                            </div>
                                            <div class="commodity__tags">
                                                <span class="commodity__price">
                                                <span class="commodity__currency">MWK</span>
                                                @if ($commodity->Price == '')
                                                    <span class="commodity__amount empty">
                                                        price
                                                        <a href="/commodity/{{ $commodity -> id }}/add_commodity_price" role="button" class="btn btn--icon">
                                                        <img class="icon" src="{{ asset('images/add-light.ico') }}" alt="">
                                                        </a>
                                                    </span>
                                                @else
                                                    <span class="commodity__amount">{{ $commodity->Price->price }}</span>
                                                @endif
                                                @if ($commodity->Unit == '')
                                                    <span class="commodity__unit empty">
                                                        /unit
                                                        <a href="/commodity/{{ $commodity -> id }}/add_commodity_unit" role="button" class="btn btn--icon">
                                                        <img class="icon" src="{{ asset('images/add-light.ico') }}" alt="">
                                                        </a>
                                                    </span>
                                                @else
                                                    <span class="commodity__unit">/{{ $commodity->Unit -> unit }}</span>

                                                @endif
                                                </span>
                                                <span class="commodity__description">{{ $commodity -> description }}</span>
                                            </div>
                                        </header>
                                        <div class="card__body">
                                        <span class="commodity__quantity">
                                            <span class="quantity-text">Quantity</span>
                                            <span class="badge quantity-value">
                                                @if ($commodity->Quantity == '')
                                                    empty
                                                @else
                                                    {{ $commodity->Quantity -> quantity }}
                                                @endif
                                            </span>
                                            <span class="commodity__unit">
                                                @if ($commodity->Unit == '')
                                                    Unit
                                                @else
                                                    {{ $commodity->Unit -> unit }}
                                                @endif
                                            </span>
                                        </span>
                                        <span class="commodity__acquisition-date">
                                            <span class="acquisition-text">Acquired On</span>
                                            @if($commodity->AquisitionDate == '')
                                                <span class="badge acquisition-date">
                                                    date
                                                </span>
                                                <span class="badge acquisition-date empty">
                                                    <a href="/commodity/{{ $commodity -> id }}/add_commodity_aquisition-date" role="button" class="btn btn--icon">
                                                        <img class="icon" src="{{ asset('images/add-dark.ico') }}" alt="">
                                                    </a>
                                                </span>
                                            @else
                                                <span class="badge acquisition-date">{{ $commodity->AquisitionDate -> aquisition_date }}</span>
                                            @endif
                                        </span>

                                        <span class="commodity__category">
                                            <span class="category-text">Category (s) :</span>
                                            <a href="{{ route('add_commodity_category', $commodity -> id) }}" role="button">
                                            <img class="icon" src="{{ asset('images/add-dark.ico') }}" alt="">
                                            </a>
                                            <div class="category-values">
                                            @forelse ($commodity -> Categories as $category)
                                                <a href="" class="link"><span class="badge category-value">{{ $category -> name }}</span></a>
                                            @empty
                                                <span class="badge category-value">no categories</span>
                                            @endforelse
                                            </div>
                                        </span>

                                        <span class="commodity__type">
                                            <span class="type-text">Type (s) :</span>
                                            <a href="{{ route('add_commodity_type', $commodity->id) }}" role="button">
                                            <img class="icon" src="{{ asset('images/add-dark.ico') }}" alt="">
                                            </a>
                                            <div class="type-values">
                                            @forelse ($commodity -> Types as $Type)
                                                <a href="{{ route('show_commodity_type', ['commodity' => $commodity->id, 'type' => $Type->id]) }}" class="link">
                                                    <span class="badge type-value">{{ $Type -> type_name }}</span>
                                                </a>
                                            @empty
                                                <span class="badge type-value">{{ $commodity -> name }} has no types</span>
                                            @endforelse
                                            </div>
                                        </span>

                                        </div>

                                        <footer class="card__footer">
                                            <div class="btn--group">
                                                <a href="{{ route('home.edit', $commodity->id) }}" class="btn btn--edit btn--icon">
                                                    <span class="icon-container icon--small">
                                                        <img class="icon" src="{{ asset('images/edit-filled.ico') }}" alt="">
                                                    </span>
                                                    <span class="btn__text">edit</span>
                                                </a>
                                                <a href="{{ route('add_commodity_type', ['id' => $commodity->id]) }}" class="btn btn--category btn--icon">
                                                    <span class="icon-container icon--small">
                                                        <img class="icon" src="{{ URL("images/category-dark.ico") }}" alt="">
                                                    </span>
                                                    <span class="btn__text">type</span>
                                                </a>

                                                <a href="{{ route('add_commodity_supply', ['id' => $commodity->id]) }}" class="btn btn--category btn--icon">
                                                    <span class="icon-container icon--small">
                                                        <img class="icon" src="{{ URL("images/sell-dark.ico") }}" alt="">
                                                    </span>
                                                    <span class="btn__text">Supplier Purchase</span>
                                                </a>
                                            </div>
                                            <div class="card__divider"></div>
                                            <div class="btn--group">
                                                <button class="btn btn--delete btn--icon btn--outline" data-bs-toggle="modal" data-bs-target="#commodityDeleteModal_{{ $commodity->id }}">
                                                    <span class="icon-container icon--small">
                                                        <img class="icon" src="{{ asset('images/del-dark.ico') }}" alt="">
                                                    </span>
                                                    <span class="btn__text">delete</span>
                                                </button>

                                                <div class="modal commodity-delete-modal fade" id="commodityDeleteModal_{{ $commodity->id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="WarningToDelete" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete {{ $commodity -> name }}?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="text-danger warning--text">
                                                                    <span class="icon-container">
                                                                    <img class="icon" src="{{ asset('images/danger-filled.ico') }}" alt="">
                                                                    </span>
                                                                    Are You Sure?
                                                                </h5>
                                                                <div class="container-fluid d-flex flex-wrap">
                                                                    You are about to delete {{ $commodity -> name }} and all its related content from your inventory!
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <form action="{{ route('home.destroy', ['home' => $commodity->id]) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button role="button" type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </footer>

                                    </div>

                                </div>

                            </div>

                            <div class="content-header">
                                <h3 class="title">{{ Str::plural('Type', $commodity->Types->count()) }} of {{ $commodity->name }}</h3>
                            </div>

                            <div class="flex flex-col--wrap">

                                @forelse ($commodity->Types as $type)
                                    {{--  <x-type :type="$type" :commodity="$commodity" />  --}}

                                    <div class="commodity">
                                        <div class="card">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    @if ($type->image_path == '')
                                                        <img class="icon" src="{{ asset('commodity_images/' . $commodity -> image_path) }}" alt="">
                                                    @else
                                                        <img class="icon" src="{{ asset('commodity_images/' . $type -> image_path) }}" alt="">
                                                    @endif
                                                    <h3 class="commodity__name">{{ $type -> type_name }}</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__price">
                                                        <span class="commodity__currency">MWK</span>
                                                        <span class="commodity__amount">
                                                            @if ($type->TypePrice == '')
                                                                00.00
                                                            @else
                                                                {{ $type->TypePrice->type_price }}
                                                            @endif

                                                        </span>
                                                        <span class="commodity__unit">/
                                                            @if ($commodity->Unit == '')
                                                                Unit
                                                            @else
                                                                {{ $commodity->Unit -> unit }}
                                                            @endif
                                                        </span>

                                                    </span>
                                                    <span class="commodity__description">
                                                        @if($type->description == '')
                                                            {{ $commodity -> description }}
                                                        @else
                                                            {{ $type->description }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <span class="commodity__quantity">
                                                    <span class="quantity-text">Quantity</span>
                                                    <span class="badge quantity-value">
                                                        @if ($type->TypeQuantity == '')
                                                            out of stock
                                                        @else
                                                            {{ $type->TypeQuantity->type_quantity }}
                                                        @endif
                                                    </span>
                                                    <span class="commodity__unit">
                                                        @if ($commodity->Unit == '')
                                                            Unit
                                                        @else
                                                            {{ $commodity->Unit -> unit }}
                                                        @endif
                                                    </span>
                                                </span>

                                                <span class="commodity__acquisition-date">
                                                    <span class="acquisition-text">Acquired On</span>
                                                    <span class="badge acquisition-date">
                                                        @if ($type->TypeAquisitionDate == '')
                                                            dd-mm-yyyy
                                                        @else
                                                            {{ $type->TypeAquisitionDate->type_aquisition_date }}
                                                        @endif
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="card__btn">
                                                <a href="{{ route('show_commodity_type', ['commodity' => $commodity->id, 'type' => $type->id]) }}" class="btn btn--primary btn--img">
                                                    <span class="btn__text">view</span>
                                                </a>
                                            </div>

                                            <footer class="card__footer">

                                                <div class="card__divider"></div>

                                                <div class="btn--group">
                                                    <button class="btn btn--delete btn--icon btn--outline" data-bs-toggle="modal" data-bs-target="#commodityDeleteModal_{{ $type->id }}">
                                                        <span class="icon-container icon--small">
                                                            <img class="icon" src="{{ asset('images/del-dark.ico') }}" alt="">
                                                        </span>
                                                        <span class="btn__text">delete</span>
                                                    </button>

                                                    <div class="modal commodity-delete-modal fade" id="commodityDeleteModal_{{ $type->id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="WarningToDelete" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete {{ $type -> name }}?</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="text-danger warning--text">
                                                                        <span class="icon-container">
                                                                        <img class="icon" src="{{ asset('images/danger-filled.ico') }}" alt="">
                                                                        </span>
                                                                        Are You Sure?
                                                                    </h5>
                                                                    <div class="container-fluid d-flex flex-wrap">
                                                                        You are about to delete {{ $type -> type_name }} and all its related content from your inventory!
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <form action="{{ route('type.destroy', ['type' => $type->id] ) }}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button role="button" type="submit" class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </footer>

                                        </div>
                                    </div>

                                @empty
                                    <div class="commodity">
                                        <div class="card">
                                            <header class="card__header">

                                                <span class="commodity__description">{{ $commodity->name }} has no types</span>

                                            </header>
                                            <div class="card__body text-wrap">
                                                If {{ $commodity->name }} has a variety of types or flavours, add them
                                            </div>
                                            <footer class="card__footer mx-auto">
                                                <small class="text-muted">
                                                    <a href="/commodity/{{ $commodity -> id }}/add_commodity_type" role="button" class="btn btn--primary btn--icon">
                                                        <span class="icon-container icon--small">
                                                            <img class="icon" src="{{ asset('images/add-light.ico') }}" alt="">
                                                        </span>
                                                    </a>
                                                </small>
                                            </footer>
                                        </div>
                                    </div>
                                @endforelse



                            </div>

                        </div>

                    </div>

                </div>

                <footer class="pps-main-content-footer">
                    <p>
                        Inventory | Commodities - Types
                    </p>
                </footer>

            </main>

        </div>

        @include('layout.main-footer')


        @include('layout.script-tags')

    </body>
</html>
