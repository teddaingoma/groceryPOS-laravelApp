<aside class="pps-sidebar collapse collapse-horizontal" id="collapseSideMenuBar">
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light pps-sidebar__nav">
        <span class="mb-3 mb-md-0 me-md-auto pps-sidebar-title">
          <span class="icon-container">
            <img class="icon" src="{{ asset('images/menubar-dark.ico') }}" alt="">
          </span>
          <span class="fs-4">Menu</span>
        </span>
        <hr class="pps-sidebar-divider">
        @auth()
            <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('home.index') }}" class="nav-link" aria-current="page">
                <span class="icon--small bi me-2">
                    <img class="icon" src="{{ asset('images/dashboard-dark.ico') }}" alt="">
                </span>
                Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('available_commodities') }}" class="nav-link link-dark">
                    <span class="icon--small bi me-2">
                        <img class="icon" src="{{ asset('images/inventory-dark.ico') }}" alt="">
                    </span>
                Inventory
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sales_report') }}" class="nav-link link-dark">
                    <span class="icon--small bi me-2">
                        <img class="icon" src="{{ asset('images/sales-dark.ico') }}" alt="">
                    </span>
                Sales
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('purchases_report') }}" class="nav-link link-dark">
                    <span class="icon--small bi me-2">
                        <img class="icon" src="{{ asset('images/purchase-dark.ico') }}" alt="">
                    </span>
                Purchases
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('financial_statements') }}" class="nav-link link-dark">
                    <span class="icon--small bi me-2">
                        <img class="icon" src="{{ asset('images/reports-dark.ico') }}" alt="">
                    </span>
                    Reports
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('view_customers') }}" class="nav-link link-dark">
                    <span class="icon--small bi me-2">
                        <img class="icon" src="{{ asset('images/customers.ico') }}" alt="">
                    </span>
                    Customers
                </a>
            </li>
            <li class="nav-item">
                <a href="}" class="nav-link link-dark">
                    <span class="icon--small bi me-2">
                        <img class="icon" src="{{ asset('images/customers.ico') }}" alt="">
                    </span>
                    Suppliers
                </a>
            </li>
            </ul>
        @endauth
        <hr>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="icon-container">
                <img class="icon rounded-circle me-2" src="{{ asset('images/account-dark.ico') }}" alt="">
            </span>
            <strong>Profile</strong>
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            @auth
                <li class="dropdown-item item-icon username">
                <span class="icon-container icon--circle">
                    <img class="icon" src="{{ asset('images/admin-light.ico') }}" alt="">
                </span>
                <a class="nav-link" href="{{ asset('pages/user_profile.html') }}">username</a>
                </li>
                <li class="dropdown-item item-icon">
                <span>
                    <img class="icon" src="{{ asset('images/profile-dark.ico') }}" alt="">
                </span>
                <a class="nav-link" href="{{ asset('pages/user_profile.html') }}">Profile</a>
                </li>
                <li class="dropdown-item item-icon">
                <span>
                    <img class="icon" src="{{ asset('images/settings2-dark.ico') }}" alt="">
                </span>
                <a class="nav-link" href="{{ asset('pages/user_profile.html') }}">Settings</a>
                </li>

            @endauth
            <li><hr class="dropdown-divider"></li>
            @auth
                <li class="dropdown-item item-icon">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn--primary btn--icon">
                            <span class="icon-container icon--small">
                                <img class="icon" src="{{ asset('images/logout-dark.ico') }}" alt="">
                            </span>
                            <span class="btn__text">logout</span>
                        </button>
                    </form>
                </li>

            @endauth
            @guest

                <li class="dropdown-item item-icon">
                    <a role="button" href="{{ route('login') }}" class="btn btn--primary btn--icon">
                        <span class="icon-container icon--small">
                            <img class="icon" src="{{ asset('images/login-dark.ico') }}" alt="">
                        </span>
                        <span class="btn__text">login</span>
                    </a>
                </li>
            @endguest
          </ul>
        </div>
    </div>
</aside>
