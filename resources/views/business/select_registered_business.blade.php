<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome {{ auth()->user()->name }}</title>
    @include('layout.head-tags')

</head>
<body class="login-body">

    <main class="form-signin login">
        <div class="pps-main-content-header">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <h1 class="login--title">Grocery POS System</h1>
        </div>
        <hr>

        <div class="pps-main-content-body">
            @if (auth()->user()->businesses()->count() > 1)

                @if(auth()->user()->businesses()->count() == 1)

                @else

                    <div class="pps-commodities">

                        <div class="flex flex-col--wrap scrollable-list">

                            <div class="commodity">
                                <div class="card">
                                    <header class="card__header">
                                        <div class="commodity__icon">
                                            <img class="icon" src="" alt="">
                                            <h3 class="commodity__name"></h3>
                                        </div>
                                        <div class="commodity__tags">
                                            <span class="commodity__price">
                                                <span class="commodity__currency">MWK</span>
                                                    <span class="commodity__amount"></span>

                                                    <span class="commodity__unit">/</span>


                                            </span>
                                            <span class="commodity__description"></span>
                                        </div>
                                    </header>
                                    <div class="card__body">
                                        <span class="commodity__quantity">
                                            <span class="quantity-text">Quantity</span>
                                            <span class="badge quantity-value">

                                            </span>
                                            <span class="commodity__unit">

                                            </span>
                                        </span>
                                        <span class="commodity__acquisition-date">
                                            <span class="acquisition-text">Acquired On</span>

                                                <span class="badge acquisition-date"></span>

                                        </span>
                                        <span class="commodity__category">
                                            <span class="category-text">Category (s) :</span>

                                            <div class="category-values">
                                                    <span class="badge category-value"></span>

                                            </div>
                                        </span>
                                        <span class="commodity__type">
                                            <span class="type-text">Type (s) :</span>
                                            <div class="type-values">

                                                    <span class="badge type-value"> has no types</span>

                                            </div>
                                        </span>
                                    </div>
                                    <div class="card__btn">

                                    </div>
                                    <footer class="card__footer">


                                    </footer>
                                </div>
                            </div>

                        </div>

                    </div>

                @endif

            @endif
        </div>

    </main>


    @include('layout.script-tags')

</body>
</html>
