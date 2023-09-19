{{ dd($business) }}
<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layout.head-tags')
        <title> Edit Business </title>
    </head>

    <body class="register-body">

        @include('layout.main-header')

        <div class="register-form">

            <div class="form--header">
                <h1 class="form--title"> Edit Customer </h1>
            </div>

            <div class="register--body">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form class="register needs-validation" action="{{ route('edit_customer') }}" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form--control-group" id="personal-details">

                        <div class="form--control-lead">
                            <img class="control-lead-icon" src="../images/personal-dark.ico" alt="">
                            <h2 class="mb-0 control-lead-text">Personal Details</h2>
                        </div>

                        <div class="row g-3">
                            <div class="names row g-3">
                                <div class="col-sm-6 form--input-line">
                                    <label for="name" class="form-label">Full Name:</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Enter customer's' full Name, Please.
                                    </div>
                                </div>
                                <div class="col-sm-6 form--input-line">
                                    <label for="customer_dp" class="form-label">Image <span class="text-muted">(Optional)</span>:</label>
                                    <input name="customer_dp" type="file" class="form-control" id="customer_dp" placeholder="" value="">
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="form--control-group" id="contact-details">

                        <div class="form--control-lead">
                            <img class="control-lead-icon" src="../images/contact.ico" alt="">
                            <h2 class="mb-0 control-lead-text">Contact Details</h2>
                        </div>

                        <div class="row g-3">

                            <div class="col-sm-6 form--input-line">
                                <label for="lastName" class="form-label">Email Address <span class="text-muted">(Optional)</span>:</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
                            </div>
                        </div>

                    </div>

                    <div class="form--btn-group">
                        <button class="btn btn--primary" type="reset">Clear</button>
                        <button class="btn btn--primary" type="submit">Add</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="container-fluid px-0 pps-footer register">
            <footer class="block footer">
                <div class="grid footer__sections">
                    <section class="footer__brand">
                        <img src="/images/logo-dark.ico" alt="">
                        <p class="footer__copyright">
                            Copyright 2022 Grocery POS system
                        </p>
                    </section>
                </div>
            </footer>
        </div>

        @include('layout.script-tags')

    </body

</html>
