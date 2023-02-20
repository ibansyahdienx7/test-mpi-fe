<!-- Modal -->
<div class="modal fade" id="keranjang" tabindex="-1" aria-labelledby="keranjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="keranjangLabel">
                    <i class='fas fa-cart-plus mr-2'></i> {{ __('messages.keranjang') }}
                </h5>
                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <form action="" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div id="cart-list"></div>
                </div>
                @if (auth()->user())
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary" role="button">
                        {{ __('messages.lanjut_pembayaran') }}
                    </button>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginLabel">
                    <i class='fas fa-user mr-2'></i> {{ __('messages.login') }}
                </h5>
                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <form action="{{ route('login.post') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-7 mb-3">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="{{ __('messages.email_contact') }} ..." autocomplete="off" required />
                                <label for="floatingInput">{{ __('messages.email_contact') }} <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required />
                                <label for="floatingPassword">Password <span class="text-danger">*</span></label>
                                <span toggle="#floatingPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <a href="" class="text-muted mt-4">
                                {{ __('messages.lupa_sandi') }} ?
                            </a>
                        </div>
                        <div class="col-lg-5" align="center">
                            <div class="section-title">
                                <h2 class="text-dark text-capitalize">{{ __('messages.atau') }}</h2>
                            </div>

                            <a class="google-button" href="{{ route('login.google') }}">
                                <div class="google-icon-wrapper">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 48 48">
                                        <g>
                                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z">
                                            </path>
                                            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z">
                                            </path>
                                            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z">
                                            </path>
                                            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z">
                                            </path>
                                            <path fill="none" d="M0 0h48v48H0z"></path>
                                        </g>
                                    </svg>
                                </div>
                                <p class="google-button-text">{{ __('messages.masuk_dengan_google') }}</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary" role="button">
                        {{ __('messages.login') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
