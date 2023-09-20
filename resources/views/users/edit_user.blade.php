<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head-tags')
        <title> edit profile | {{ auth()->user()->name }} </title>
</head>
<body class="register-body">

    @include('layout.main-header')

  <div class="register-form">

    <div class="form--header">
        <img class="form--brand" src="{{ asset('images/maintenance-light.ico') }}" alt="">
        <h1 class="form--title">Edit your profile </h1>
    </div>

    <div class="register--body">
      <form class="register needs-validation" action="{{ route('edit_user') }}" method="POST" novalidate>
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
                <label for="firstName" class="form-label">change name:</label>
                <input type="text" class="form-control @error('name') border-danger @enderror" name="name" id="firstName" placeholder="{{ auth()->user()->name }}" value="{{ auth()->user()->name }}" required>
                <div class="invalid-feedback">
                    Enter your Full Name, Please.
                </div>
                @error('name')
                    <div class="text-danger m-0 p-1">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="col-sm-6 form--input-line">
                <label for="username" class="form-label">change username:</label>
                <input type="text" class="form-control @error('username') border-danger @enderror" name="username" id="username" placeholder="{{ auth()->user()->username }}" value="{{ auth()->user()->username }}" required>
                <div class="invalid-feedback">
                  Choose a username, Please.
                </div>
                @error('username')
                    <div class="text-danger m-0 p-1">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="col-sm-6 form--input-line">
                <label for="email" class="form-label">change email:</label>
                <input type="email" class="form-control  @error('email') border-danger @enderror"  name="email" id="email" placeholder="{{ auth()->user()->email }}" value="{{ auth()->user()->email }}" required>
                <div class="invalid-feedback">
                  Enter your email, Please.
                </div>
                @error('email')
                    <div class="text-danger m-0 p-1">
                        {{ $message }}
                    </div>
                @enderror
              </div>
            </div>

            <div class="card__btn">
                <a href="{{ route('change_password') }}" class="btn btn--primary btn--img">
                    <span class="btn__text">Change Password</span>
                </a>
            </div>

        </div>

        <div class="form--btn-group">

          <button class="btn btn--primary" type="submit">Update</button>
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
