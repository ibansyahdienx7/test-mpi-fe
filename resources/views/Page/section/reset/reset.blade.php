<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="{{ route('index') }}">{{ __('messages.home') }}</a></li>
            <li>Reset Password</li>
        </ol>
        <h2>Reset Password</h2>

    </div>
</section><!-- End Breadcrumbs -->

<section id="cta" class="cta reset">
    <div class="container">

        <form action="{{ route('reset.post') }}" method="POST">
            {{ csrf_field() }}
            <div class="row" data-aos="zoom-in">
                <div class="col-lg-9 text-center text-lg-start">
                    <h3 class="mb-4">Reset Password</h3>
                    <p>
                        <input type="hidden" class="form-control" name="email" value="{{ $user->email }}" readonly />
                        <div class="relative z-0 mt-4 mb-5 border-b-2 border-white-200">
                            <input type="password" id="floating_standard" class="block py-2.5 px-0 w-full text-md text-white bg-transparent border-0 border-b-2 border-white-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_standard" class="text-white absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                New Password <span class="text-danger">*</span>
                            </label>
                            <span toggle="#floating_standard" class="text-white fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="relative z-0 border-b-2 border-white-200 mb-4 mt-5">
                            <input type="password" name="password" id="floating_standard2" class="block py-2.5 px-0 w-full text-md text-white bg-transparent border-0 border-b-2 border-white-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_standard2" class="text-white absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Confirm Password <span class="text-danger">*</span>
                            </label>
                            <span toggle="#floating_standard2" class="text-white fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <small class="mt-2 text-white text-capitalize" id="alert-reset"></small>
                    </p>
                </div>
                <div class="col-lg-2 cta-btn-container text-center">
                    <button type="submit" class="cta-btn align-middle" role="button">
                        Submit
                    </button>
                </div>
            </div>
        </form>

    </div>
</section>
