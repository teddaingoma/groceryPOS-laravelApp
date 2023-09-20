<aside class="pps-sidebar-icon">
    <div class="d-flex flex-column flex-shrink-0 bg-light pps-sidebar__nav-icon">
        <span class="d-block pps-sidebar-icon-title" title="Icon-only" data-bs-toggle="tooltip" data-bs-placement="right">
            <span class="icon-container bi me-2">
                <img class="icon" src="{{ asset('images/menubar-dark.ico') }}" alt="">
            </span>
          <span class="visually-hidden">Menu Icon</span>
        </span>
        <hr class="pps-sidebar-divider">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
          <li class="nav-item">
            <a href="{{ route('home.index') }}" class="nav-link py-3 border-bottom" aria-current="page" title="Dashboard" data-bs-toggle="tooltip" data-bs-placement="right">
                <span class="icon--small bi me-2">
                    <img class="icon" src="{{ asset('images/dashboard-dark.ico') }}" alt="">
                </span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('available_commodities') }}" class="nav-link py-3 border-bottom" title="Inventory" data-bs-toggle="tooltip" data-bs-placement="right">
                <span class="icon--small bi me-2">
                    <img class="icon" src="{{ asset('images/inventory-dark.ico') }}" alt="">
                </span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('sales_report') }}" class="nav-link py-3 border-bottom" title="Sales" data-bs-toggle="tooltip" data-bs-placement="right">
                <span class="icon--small bi me-2">
                    <img class="icon" src="{{ asset('images/sales-dark.ico') }}" alt="">
                </span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('purchases_report') }}" class="nav-link py-3 border-bottom" title="Purchases" data-bs-toggle="tooltip" data-bs-placement="right">
                <span class="icon--small bi me-2">
                    <img class="icon" src="{{ asset('images/purchase-dark.ico') }}" alt="">
                </span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('financial_statements') }}" class="nav-link py-3 border-bottom" title="Reports" data-bs-toggle="tooltip" data-bs-placement="right">
                <span class="icon--small bi me-2">
                    <img class="icon" src="{{ asset('images/reports-dark.ico') }}" alt="">
                </span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('view_customers') }}" class="nav-link py-3 border-bottom" title="Customers" data-bs-toggle="tooltip" data-bs-placement="right">
                <span class="icon--small bi me-2">
                    <img class="icon" src="{{ asset('images/customers.ico') }}" alt="">
                </span>
            </a>
          </li>
        </ul>
        <div class="dropdown border-top">
          <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" title="Account" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="icon-container">
                <img class="icon rounded-circle me-2" src="{{ asset('images/account-dark.ico') }}" alt="">
            </span>
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
            <li class="dropdown-item item-icon username">
              <span class="icon-container icon--circle">
                <img class="icon" src="{{ asset('images/admin-light.ico') }}" alt="">
              </span>
              <a class="nav-link" href="{{ route('view_user_profile') }}">{{ auth()->user()->username }}</a>
            </li>
            <li class="dropdown-item item-icon">
              <span>
                <img class="icon" src="{{ asset('images/profile-dark.ico') }}" alt="">
              </span>
              <a class="nav-link" href="{{ route('view_user_profile') }}">Profile</a>
            </li>
            <li class="dropdown-item item-icon">
              <span>
                <img class="icon" src="{{ asset('images/settings2-dark.ico') }}" alt="">
              </span>
              <a class="nav-link" href="{{ route('view_user_profile') }}">Settings</a>
            </li>
            <li><hr class="dropdown-divider"></li>
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
          </ul>
        </div>
    </div>
</aside>
