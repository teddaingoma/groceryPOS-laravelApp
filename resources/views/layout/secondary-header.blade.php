<div class="container-fluid px-0 pps-header">
    <header>
        <nav class="navbar navbar-expand-lg bg-light pps-primary-navbar fixed-top" aria-label="Primary Nav bar">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{ route('home.index') }}">
                <span class="icon--circle">
                    <img class="icon" src="{{ asset('images/logo-dark.ico') }}" alt="">
                </span>
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ppsPrimaryNavbar" aria-controls="ppsPrimaryNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-container">
                  <img class="icon" src="{{ asset('images/menu-dark.ico') }}" alt="">
                </span>
              </button>
              <div class="collapse navbar-collapse" id="ppsPrimaryNavbar">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0 pps-main-nav">

                  <li class="nav-item item-icon">
                    <span class="icon--circle">
                      <img class="icon" src="{{ asset('images/home-dark.ico') }}" alt="">
                    </span>
                    <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                  </li>

                </ul>

                @auth
                    <div class="user">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="icon--circle">
                                    <img class="icon" src="{{ asset('images/admin-light.ico') }}" alt="">
                                </span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="profile">

                                <li class="dropdown-item item-icon">
                                <span>
                                    <img class="icon" src="{{ asset('images/register-dark.ico') }}" alt="">
                                </span>
                                <a class="nav-link" href="{{ route('register_business') }}">register</a>
                                </li>

                                <li class="dropdown-item item-icon">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn--img btn--link">
                                            <span class="icon-container">
                                                <img class="icon" src="{{ asset('images/logout-dark.ico') }}" alt="">
                                            </span>
                                            <span class="btn__text">logout</span>
                                        </button>
                                    </form>
                                </li>

                            </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('view_user_profile') }}" class="nav-link">{{ auth()->user()->name }}</a>
                            </li>
                        </ul>
                    </div>
                @endauth

              </div>
            </div>
        </nav>
    </header>
</div>
