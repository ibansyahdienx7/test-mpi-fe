<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-newsletter">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h4>{{ __('messages.buletin') }}</h4>
                    <p>{{ __('messages.news_desc') }}</p>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('realtime.subscribe') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="email" name="email" placeholder="{{ __('messages.email_contact') }} ..." autocomplete="off" required />
                        <input type="submit" value="Subscribe">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>{{ config('app.brand') }}</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('index') }}">{{ __('messages.home') }}</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('product') }}">{{ __('messages.product') }}</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">{{ __('messages.toko') }}</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Wishlist</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#" class="cart-btn" data-bs-toggle="modal" data-bs-target="#keranjang">{{ __('messages.keranjang') }}</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Promo</a></li>
                        <li class="d-none"><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li class="d-none"><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-contact">
                    <h4>{{ __('messages.kontak_kami') }}</h4>
                    <p>
                        {{ config('app.alamat') }}<br /><br />
                        <strong>Phone:</strong>
                        <a href="{{ config('app.link_wa') }}" target="_blank">
                            {{ config('app.wa') }}
                        </a>
                        <br />
                        <strong>Email:</strong>
                        <a href="{{ config('app.link_email') }}" target="_blank">
                            {{ config('app.email_company') }}
                        </a>
                        <br />
                    </p>

                </div>

                <div class="col-lg-5 col-md-6 footer-info">
                    <h3>{{ __('messages.tentang_kami') }} {{ config('app.brand_name') }}</h3>
                    <p>
                        <div id="footer_about"></div>
                    </p>
                    <div class="social-links mt-3">
                        <a href="{{ config('app.twitter') ? config('app.twitter') : '#'  }}" {{ config('app.twitter') ? 'target="_blank"' : ''  }} class="twitter {{ config('app.twitter') ? '' : 'd-none'  }}"><i class="bx bxl-twitter"></i></a>
                        <a href="{{ config('app.facebook') ? config('app.facebook') : '#'  }}" {{ config('app.facebook') ? 'target="_blank"' : ''  }} class="facebook {{ config('app.facebook') ? '' : 'd-none'  }}"><i class="bx bxl-facebook"></i></a>
                        <a href="{{ config('app.instagram') ? config('app.instagram') : '#'  }}" {{ config('app.instagram') ? 'target="_blank"' : ''  }} class="instagram {{ config('app.instagram') ? '' : 'd-none'  }}"><i class="bx bxl-instagram"></i></a>
                        <a href="{{ config('app.google') ? config('app.google') : '#'  }}" {{ config('app.google') ? 'target="_blank"' : ''  }} class="google-plus {{ config('app.google') ? '' : 'd-none'  }}"><i class='bx bx-envelope-open'></i></a>
                        <a href="{{ config('app.linkedin') ? config('app.linkedin') : '#'  }}" {{ config('app.linkedin') ? 'target="_blank"' : ''  }} class="linkedin {{ config('app.linkedin') ? '' : 'd-none'  }}"><i class="bx bxl-linkedin"></i></a>
                    </div>

                    <div id="list-payment" class=" footer-links mt-4"></div>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright {{ date('Y') }} <strong><span>{{ config('app.brand') }}</span></strong>. All Rights Reserved
        </div>
    </div>
</footer><!-- End Footer -->
<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
