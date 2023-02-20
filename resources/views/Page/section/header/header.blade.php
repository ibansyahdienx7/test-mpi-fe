<!-- ======= Top Bar ======= -->
<div id="topbar" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope-fill"></i>
            <a href="{{ config('app.link_email') }}" target="_blank">
                {{ config('app.email_company') }}
            </a>
            <i class="bi bi-phone-fill phone-icon"></i>
            <a href="{{ config('app.link_wa') }}" target="_blank">
                {{ config('app.wa') }}
            </a>
        </div>
        <div class="cta d-none d-md-block">
            <a href="#about" class="cart-btn" data-bs-toggle="modal" data-bs-target="#keranjang"><i class='fas fa-cart-plus mr-2'></i> {{ __('messages.keranjang') }}</a>
        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="{{ route('index') }}">{{ config('app.brand') }}</a></h1>

        <nav id="navbar" class="navbar">
            <ul>
                <li class="d-logo-mobile">
                    <a href="{{ route('index') }}">
                        <img src="{{ config('app.url') . '/assets/template/assets/img/ibanlogo.png' }}" class="img-fluid" alt="{{ config('app.brand_company') }}" title="{{ config('app.brand_company') }}" />
                    </a>
                </li>
                <li><a class="nav-link scrollto {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">{{ __('messages.home') }}</a></li>
                <li><a class="nav-link scrollto {{ request()->routeIs('product') ? 'active' : '' }}" href="{{ route('product') }}">{{ __('messages.product') }}</a></li>
                <li><a class="nav-link scrollto" href="#services">{{ __('messages.toko') }}</a></li>
                <li><a class="nav-link scrollto" href="#services">Promo</a></li>
                <li><a class="nav-link scrollto" href="#contact">{{ __('messages.contact') }}</a></li>
                <li id="carts">
                    <a class="nav-link cart-btn nav-cart m-0" href="#" data-bs-toggle="modal" data-bs-target="#keranjang">
                        <span><i class="fas fa-cart-plus mr-2"></i> {{ __('messages.keranjang') }} </span>
                    </a>
                </li>
                <li id="carts-mobile">
                    <a class="nav-link cart-btn nav-cart p-3" href="#" data-bs-toggle="modal" data-bs-target="#keranjang">
                        <span><i class="fas fa-cart-plus mr-2"></i> {{ __('messages.keranjang') }} </span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#">
                        <span>
                            <i class="fas fa-user mr-2"></i>
                            {{ auth()->user() ? auth()->user()->name : __('messages.akun') }}
                        </span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                        @if (auth()->user())
                        <li><a href="#">{{ __('messages.buat_toko') }} (Coming Soon)</a></li>
                        <li><a href="">Wishlist</a></li>
                        <li><a href="{{ route('exit') }}">{{ __('messages.logout') }}</a></li>
                        @else
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#login">{{ __('messages.login') }}</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#sign-up">{{ __('messages.daftar') }}</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
