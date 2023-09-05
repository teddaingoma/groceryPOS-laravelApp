<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head-tags')
    <title> {{  auth()->user()->name  }} | register grocery business </title>
</head>

<body class="register-body">

    <div class="register-form">

    <div class="form--header">
        <img class="form--brand" src="{{ asset('images/register-light.ico') }}" alt="">
        <h1 class="form--title">Register your Grocery Business </h1>
    </div>

    <div class="register--body">
        <form class="register needs-validation" action="{{ route('register_business') }}" method="POST" novalidate>
        @csrf
        <div class="form--control-group" id="personal-details">

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="form--control-lead">
                <img class="control-lead-icon" src="{{ asset('images/personal-dark.ico') }}" alt="">
                <h2 class="mb-0 control-lead-text">Grocery Business Details</h2>
            </div>

            <div class="d-flex flex-column align-items-center names row g-3">
                <div class="col-sm-6 form--input-line">
                <label for="name" class="form-label">name:</label>
                <input type="text" class="form-control @error('name') border-danger @enderror" name="name" id="name" placeholder="provide a full name of your business" required>
                <div class="invalid-feedback">
                    Enter the Full Name, Please.
                </div>
                @error('name')
                    <div class="text-danger m-0 p-1">
                        {{ $message }}
                    </div>
                @enderror
                </div>
                <div class="col-sm-6 form--input-line">
                <label for="description" class="form-label">description:</label>
                <textarea name="description" class="form-control" id="description" placeholder="describe your business in a few words..." aria-label="grocery-descriprion" required></textarea>

                @error('description')
                    <div class="text-danger m-0 p-1">
                        {{ $message }}
                    </div>
                @enderror


                <div class="form--btn-group">
                    <button class="btn btn--primary" type="reset">Clear</button>
                    <button class="btn btn--primary" type="submit">Create</button>
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
