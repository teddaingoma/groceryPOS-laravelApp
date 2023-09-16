@props(['customer' => $customer])

<div class="commodity">
    <div class="card">
        <header class="card__header">
            <div class="commodity__icon">
                <img class="icon" src="{{ asset('customer_images/' . $customer->image_path) }}" alt="">
                <h3 class="commodity__name">{{  $customer->name }}</h3>
            </div>
            <div class="commodity__tags">
                <span class="commodity__description">{{ $customer->email }}</span>
            </div>
        </header>

        <footer class="card__footer">

            <div class="card__divider"></div>
            <div class="btn--group">
                {{--  <a href="{{ route('edit_customer', $customer) }}" class="btn btn--edit btn--icon">
                    <span class="icon-container icon--small">
                        <img class="icon" src="{{ URL("images/edit-filled.ico") }}" alt="">
                    </span>
                    <span class="btn__text">edit</span>
                </a>  --}}
                <button class="btn btn--delete btn--icon btn--outline" data-bs-toggle="modal" data-bs-target="#deleteCustomerModal_{{ $customer->id }}">
                    <span class="icon-container icon--small">
                        <img class="icon" src="{{ asset('images/del-dark.ico') }}" alt="">
                    </span>
                    <span class="btn__text">delete</span>
                </button>

                <div class="modal fade" id="deleteCustomerModal_{{ $customer->id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-labelledby="WarningToDelete" aria-hidden="true">
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
                                You are about to delete {{ $customer->name }}. The transactions done with this customer will still be available.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('delete_customer', $customer) }}" method="post">
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
