<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head-tags')
        <title> change password | {{ auth()->user()->name }} </title>
</head>
<body class="register-body">

    @include('layout.main-header')

  <div class="register-form">

    <div class="form--header">
        <img class="form--brand" src="{{ asset('images/maintenance-light.ico') }}" alt="">
        <h1 class="form--title">Change Password </h1>
    </div>

    <div class="register--body">
      <form class="register needs-validation" action="{{ route('change_password') }}" method="POST" novalidate>
        @csrf
        @method('PUT')
        <div class="form--control-group" id="personal-details">

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

          <div class="form--control-lead">
            <img class="control-lead-icon" src="{{ asset('images/personal-dark.ico') }}" alt="">
            <h2 class="mb-0 control-lead-text">Change Personal Details</h2>
          </div>

            <div class="d-flex flex-column align-items-center names row g-3">
                <div class="col-sm-6 form--input-line">
                    <label for="password" class="form-label">password:</label>
                    <input type="password" class="form-control @error('password') border-danger @enderror"  name="password" id="password" placeholder="enter new password" value="" required>
                    <div class="invalid-feedback">
                      Choose a password, Please.
                    </div>
                    @error('password')
                        <div class="text-danger m-0 p-1">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="col-sm-6 form--input-line">
                    <label for="password_confirmation" class="form-label">repeat password:</label>
                    <input type="password" class="form-control"  name="password_confirmation" id="password_confirmation" placeholder="Repeat your new password" value="" required>
                    <div class="invalid-feedback">
                     Repeat your password, Please.
                    </div>
                  </div>
                </div>
            </div>

            <div class="form--btn-group">

                <button class="btn btn--primary" type="submit">Update</button>
        </div>

          </div>
      </form>
    </div>

  </div>

  <div class="container-fluid px-0 pps-footer register">
      <footer class="block footer">
        <div class="grid footer__sections">
            <section class="footer__brand">
                <img src="{{ asset('images/logo-dark.ico') }}" alt="">
                <p class="footer__copyright">
                    Copyright 2022 Grocery POS system
                </p>
            </section>
        </div>
      </footer>
  </div>

  @include('layout.script-tags')

</body>
</html>
