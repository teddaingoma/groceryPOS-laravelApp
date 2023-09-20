<div class="container-fluid px-0 pps-footer">
    <footer class="block block--dark footer">
      <div class="grid footer__sections">
        @if (auth()->user()->businesses !== null)
          <section class="collapsible collapsible--expanded footer__section">
              <header class="collapsible__header">
                  <h2 class="collapsible__heading footer__heading">Products</h2>
                  <img src="{{ asset('images/chevron-light.ico') }}" alt="" class="icon icon--white collapsible__chevron">
              </header>
              <div class="collapsible__content">
                  <ul class="list">
                      <li><a href="{{ route('home.index') }}">View Commodities</a></li>
                  </ul>
              </div>
          </section>
          <section class="collapsible footer__section">
              <header class="collapsible__header">
                  <h2 class="collapsible__heading footer__heading">Business</h2>
                  <img src="{{ asset('images/chevron-light.ico') }}" alt="" class="icon icon--white collapsible__chevron">
              </header>
              <div class="collapsible__content">
                  <ul class="list">
                      <li><a href="{{ route('view_business', auth()->user()->businesses) }}">About</a></li>
                      <li><a href="#">Affiliates</a></li>
                      <li><a href="#">Blog</a></li>
                  </ul>
              </div>
          </section>
          <section class="collapsible footer__section">
              <header class="collapsible__header">
                  <h2 class="collapsible__heading footer__heading">Support</h2>
                  <img src="{{ asset('images/chevron-light.ico') }}" alt="" class="icon icon--white collapsible__chevron">
              </header>
              <div class="collapsible__content">
                  <ul class="list">
                      <li><a href="{{ route('view_business', auth()->user()->businesses) }}">Contact</a></li>
                      <li><a href="#">Knowledge Base</a></li>
                      <li><a href="#">FAQ</a></li>
                  </ul>
              </div>
          </section>
          <section class="collapsible footer__section">
              <header class="collapsible__header">
                  <h2 class="collapsible__heading footer__heading">Find Us</h2>
                  <img src="{{ asset('images/chevron-light.ico') }}" alt="" class="icon icon--white collapsible__chevron">
              </header>
              <div class="collapsible__content">
                  <ul class="list list--icon">
                      <li><a href="{{ route('view_business', auth()->user()->businesses) }}">
                        <span class="icon-container icon--small">
                            <img class="icon" src="{{ asset('images/whatsapp.ico') }}" alt="">
                        </span>
                        <span>whatsapp</span>
                      </a></li>
                      <li><a href="{{ route('view_business', auth()->user()->businesses) }}">
                        <span class="icon-container icon--small">
                            <img class="icon" src="{{ asset('images/facebook.ico') }}" alt="">
                        </span>
                        <span>facebook</span>
                      </a></li>
                      <li><a href="{{ route('view_business', auth()->user()->businesses) }}">
                        <span class="icon-container icon--small">
                            <img class="icon" src="{{ asset('images/instagram.ico') }}" alt="">
                        </span>
                        <span>instagram</span>
                      </a></li>
                      <li><a href="{{ route('view_business', auth()->user()->businesses) }}">
                        <span class="icon-container icon--small">
                            <img class="icon" src="{{ asset('images/twitter.ico') }}" alt="">
                        </span>
                        <span>twitter</span>
                      </a></li>
                  </ul>
              </div>
          </section>
          @endif
          <section class="footer__brand">
              <img src="{{ asset('images/logo-light.ico') }}" alt="">
              <p class="footer__copyright">
                  Copyright 2022 Grocery POS system
                  @auth
                    @if (auth()->user()->businesses !== null)
                        {{ auth()->user()->businesses->name }}
                    @else
                        {{ auth()->user()->name }}
                    @endif
                  @endauth
              </p>
          </section>
      </div>
    </footer>
</div>
