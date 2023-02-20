<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="{{ route('index') }}">{{ __('messages.home') }}</a></li>
            <li><a href="{{ route('product') }}">{{ __('messages.product') }}</a></li>
            <li>{{ substr($product->name, 0, 15) . '....' }}</li>
        </ol>
        <h2>{{ __('messages.product') }} Details - {{ $product->name }}</h2>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details">
    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-8">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        <div class="swiper-slide">
                            <img src="{{ $product->photo }}" alt="{{ $product->name }}">
                        </div>

                        <div class="swiper-slide">
                            <img src="{{ $product->second_photo ? $product->second_photo : config('app.url') . '/assets/img/noimg.png' }}" alt="{{ $product->name }}">
                        </div>

                        <div class="swiper-slide">
                            <img src="{{ $product->third_photo ? $product->third_photo : config('app.url') . '/assets/img/noimg.png' }}" alt="{{ $product->name }}">
                        </div>

                    </div>
                    <div class="swiper-button-prev swiper-custom-navs"></div>
                    <div class="swiper-button-next swiper-custom-navs"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info animate__animated animate__fadeInLeft">
                    <h3>{{ $product->name }}</h3>
                    <ul>
                        <li><strong>{{ __('messages.kategori') }}</strong>: {{ $category }}</li>
                        <li>
                            <div class="d-flex">
                                <strong>{{ __('messages.toko') }}</strong>:
                                <img src="{{ $product->photo_store }}" class="rounded-full img-toko ml-3 mr-3" alt="{{ $product->name_store }}" title="{{ $product->name_store }}" />
                                <label class="mt-2 fw-bold">{{ $product->name_store }}</label>
                            </div>
                        </li>
                        <li><strong>Tag</strong>: {{ $product->tag_product }}</li>
                        <li><strong>{{ __('messages.ukuran') }}</strong>: @php echo $product->status_size == 1 ? $result_size : '-'; @endphp</li>
                        <li><strong>Variant</strong>: @php echo $product->status_variant == 1 ? $result_variant : '-'; @endphp</li>
                        <li><strong>Discount</strong>: @php echo $discount; @endphp</li>
                        <li><strong>{{ __('messages.harga') }}</strong>: @php echo $harga; @endphp</li>
                        <li><strong>Rate</strong>: ⭐ @php echo $product->rate_product; @endphp</li>
                        <li align="center">
                            <button type="button" class="btn btn-sm btn-primary">
                                <i class="fas fa-cart-plus"></i> {{ __('messages.tambah_keranjang') }}
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="portfolio-description animate__animated animate__fadeInLeft">
                    <h2>Note</h2>
                    <p>
                        <div class="full-width p-0 m-0">
                            <div class="page-width p-0 m-0">
                                <div class="expander p-0 m-0">
                                    <div class="inner-bit p-0 m-0">
                                        <p class="text-left p-0 m-0">
                                            @php
                                            echo $note;
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                                <button class="button expand-toggle mt-3 mb-3" href="javascript:void(0)">
                                    {{ __('messages.tampilkan_lebih_banyak') }}
                                </button>
                            </div>
                        </div>
                    </p>
                </div>

                <div class="portfolio-description animate__animated animate__fadeInLeft">
                    <h2>{{ __('messages.descrip') }}</h2>
                    <p>
                        <div class="full-width p-0 m-0">
                            <div class="page-width p-0 m-0">
                                <div class="expander p-0 m-0">
                                    <div class="inner-bit p-0 m-0">
                                        <p class="text-left p-0 m-0">
                                            @php
                                            echo $description_product;
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                                <button class="button expand-toggle mt-3 mb-3" href="javascript:void(0)">
                                    {{ __('messages.tampilkan_lebih_banyak') }}
                                </button>
                            </div>
                        </div>
                    </p>
                </div>

            </div>

        </div>

    </div>
</section><!-- End Portfolio Details Section -->
