<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Grocery Portable Point-Of-Sales system for small-scale grocery businesses">
    <meta name="author" content="teddai Ngoma">
    <title>Login | gpos</title>
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
<body class="login-body no-nav">

    <main class="form-signin login">
        <h1 class="login--title">Grocery POS System</h1>
        <hr>
        <form class="login--form needs-validation" action="{{ route('login') }}" method="POST" novalidate>
            @csrf
            @if (session('status'))
                <div class="alert alert-danger alert-dismissible fade show text-wrap" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="form--control-lead">
                <img class="control-lead-icon" src="{{ asset('images/login-dark.ico') }}" alt="">
                <h2 class="mb-0 control-lead-text">Please sign in</h2>
            </div>

            <div class="form-floating form--input-line">
                <input name="username" type="email" class="form-control  @error('username') border-danger @enderror" id="floatingInput" placeholder="usrname@gpos.com" value="{{ old('username') }}" required>
                <label for="floatingInput">username</label>
                <div class="invalid-feedback">
                    input your username, Please.
                  </div>
                  @error('username')
                      <div class="text-danger m-0 p-1">
                          {{ $message }}
                      </div>
                  @enderror
            </div>
            <div class="form-floating form--input-line">
                <input name="password" type="password" class="form-control  @error('password') border-danger @enderror" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
                <div class="invalid-feedback">
                    input your password, Please.
                  </div>
                  @error('password')
                      <div class="text-danger m-0 p-1">
                          {{ $message }}
                      </div>
                  @enderror
            </div>

            <div class="checkbox mb-3 login--checkbox">
                <label>
                    <input name="remember" type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn--primary" type="reset">Clear</button>
            <button class="btn btn--primary" type="submit">Sign in</button>
            <a class="nav-link" href="{{ route('signup') }}">Own a grocery? create an account?</a>
        </form>
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
