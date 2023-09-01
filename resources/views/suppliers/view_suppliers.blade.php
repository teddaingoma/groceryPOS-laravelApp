@extends('layout.app')

@section('content')

  <div class="pps-main-content-header">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="pps-main-content-title">Suppliers</h2>
  </div>

  <div class="pps-main-content-body">
    <nav class="pps-body-nav">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Suppliers</button>

        </div>
      </nav>
    <div class="tab-content pps-body-content" id="nav-tabContent">

      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

        <div class="pps-commodities">

            <div class="flex flex-col--wrap scrollable-list">
                @forelse (auth()->user()->suppliers as $supplier)
                    <div class="commodity">
                        <div class="card">
                            <header class="card__header">
                                <div class="commodity__icon">
                                    <img class="icon" src="{{ asset('supplier_images/' . $supplier->image_path) }}" alt="">
                                    <h3 class="commodity__name">{{  $supplier->name }}</h3>
                                </div>
                                <div class="commodity__tags">
                                    <span class="commodity__description">{{ $supplier->email }}</span>
                                </div>
                            </header>

                            <footer class="card__footer">

                                <div class="card__divider"></div>
                                <div class="btn--group">
                                    <button class="btn btn--delete btn--icon btn--outline" data-bs-toggle="modal" data-bs-target="#commodityDeleteModal">
                                        <span class="icon-container icon--small">
                                            <img class="icon" src="{{ asset('images/del-dark.ico') }}" alt="">
                                        </span>
                                        <span class="btn__text">delete</span>
                                    </button>

                                    <div class="modal fade" id="commodityDeleteModal" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="WarningToDelete" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete </h5>
                                                <span class="btn icon-container" data-bs-dismiss="modal" aria-label="Close">
                                                    <img class="icon" src="{{ asset('images/close-dark.ico') }}" alt="">
                                                </span>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="text-danger warning--text">
                                                    <span class="icon-container">
                                                    <img class="icon" src="{{ asset('images/danger-filled.ico') }}" alt="">
                                                    </span>
                                                    Are You Sure?
                                                </h5>
                                                <div class="container-fluid">
                                                    You are about to delete  and all its related content from your inventory!
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button role="button" type="submit" class="btn">Delete</button>
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
                        <p> {{ auth()->user()->name }}, you have no suppliers </p>

                        <button class="btn btn--primary btn--icon btn--outline">
                            <img class="icon" src="{{ asset('images/add-cus-dark.ico') }}" alt="">
                            <span class="btn__text">
                                <a class="nav-link" href="{{ route('add_supplier') }}">Add</a>
                            </span>
                        </button>
                    </div>
                @endforelse
            </div>

        </div>

      </div>

    </div>
  </div>

@endsection
