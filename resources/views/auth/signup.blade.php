<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Grocery Portable Point-Of-Sales system for small-scale grocery businesses">
    <meta name="author" content="teddai Ngoma">
    <title>Create Account</title>
    <meta name="description" content="Portable POS system">
    <meta property="og:title" content="Portable POS system">
    <meta property="og:description" content="Portable POS system">
    <meta property="og:type" content="website">
    <meta property="og:image" content="http://">
    <meta property="og:url" content="https://grocerypos.netlify.app">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


    <!-- HypeGames icon -->
    <link rel="icon" href="{{ asset('images/logo-dark.ico') }}">
</head>
<body class="register-body">


  <div class="register-form">

    <div class="form--header">
        <img class="form--brand" src="{{ asset('images/register-light.ico') }}" alt="">
        <h1 class="form--title">create an account </h1>
    </div>

    <div class="register--body">
      <form class="register needs-validation" action="" novalidate>

        <div class="form--control-group" id="personal-details">

          <div class="form--control-lead">
            <img class="control-lead-icon" src="{{ asset('images/personal-dark.ico') }}" alt="">
            <h2 class="mb-0 control-lead-text">Personal Details</h2>
          </div>

            <div class="d-flex flex-column align-items-center names row g-3">
              <div class="col-sm-6 form--input-line">
                <label for="firstName" class="form-label">name:</label>
                <input type="text" class="form-control" name="name" id="firstName" placeholder="full name" value="" required>
                <div class="invalid-feedback">
                  Enter your Full Name, Please.
                </div>
              </div>
              <div class="col-sm-6 form--input-line">
                <label for="email" class="form-label">email:</label>
                <input type="email" class="form-control"  name="email" id="email" placeholder="email" value="" required>
                <div class="invalid-feedback">
                  Enter your email, Please.
                </div>
              </div>
              <div class="col-sm-6 form--input-line">
                <label for="password" class="form-label">password:</label>
                <input type="password" class="form-control"  name="password" id="password" placeholder="choose a password" value="" required>
                <div class="invalid-feedback">
                  Choose a password, Please.
                </div>
              </div>
              <div class="col-sm-6 form--input-line">
                <label for="password_confirmation" class="form-label">repeat password:</label>
                <input type="password" class="form-control"  name="password_confirmation" id="password_confirmation" placeholder="Repeat your password" value="" required>
                <div class="invalid-feedback">
                 Repeat your password, Please.
                </div>
              </div>
            </div>

        </div>

        <div class="form--btn-group">
          <button class="btn btn--primary" type="reset">Clear</button>
          <button class="btn btn--primary" type="submit">Create</button>
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


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="{{ asset('js/jquery.min.js') }}" ></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
