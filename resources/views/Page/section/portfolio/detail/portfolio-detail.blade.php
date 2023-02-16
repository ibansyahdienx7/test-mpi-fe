<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details">
    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-8">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        <div class="swiper-slide">
                            <img src="{{ $master_photo }}" alt="{{ $name }} - {{ $client }}" title="{{ $name }} - {{ $client }}">
                        </div>

                        <div class="swiper-slide">
                            <img src="{{ $second_photo }}" alt="{{ $name }} - {{ $client }}" title="{{ $name }} - {{ $client }}">
                        </div>

                        <div class="swiper-slide">
                            <img src="{{ $third_photo }}" alt="{{ $name }} - {{ $client }}" title="{{ $name }} - {{ $client }}">
                        </div>

                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev swiper-custom-navs"></div>
                    <div class="swiper-button-next swiper-custom-navs"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info">
                    <h3>Project Information</h3>
                    <ul>
                    <li><strong>{{ __('messages.kategori') }}</strong>: {{ $category }}</li>
                    <li><strong>Client</strong>: {{ $client }}</li>
                    <li><strong>Project Date</strong>: {{ $project_date }}</li>
                    <li><strong>Project URL</strong>: <a href="{{ $url }}" target="_blank">{{ $url }}</a></li>
                    </ul>
                </div>
                <div class="portfolio-description">
                    <h2>{{ $deskripsi_title }}</h2>
                    <p>
                        <div class="full-width p-0 m-0">
                            <div class="page-width p-0 m-0">
                                <div class="expander p-0 m-0">
                                    <div class="inner-bit p-0 m-0">
                                        <p class="text-left p-0 m-0">
                                            @php echo $deskripsi; @endphp
                                        </p>
                                    </div>
                                </div>
                                <button class="button expand-toggle" href="javascript:void(0)">
                                    {{ __('messages.tampilkan_lebih_banyak') }}
                                </button>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(".expand-toggle").click(function (e) {
                                e.preventDefault();

                                var $this = $(this);
                                var expandHeight = $this.prev().find(".inner-bit").height();

                                if ($this.prev().hasClass("expanded")) {
                                    $this.prev().removeClass("expanded");
                                    $this.prev().attr("style", "");
                                    $this.html("{{ __('messages.tampilkan_lebih_banyak') }}");
                                } else {
                                    $this.prev().addClass("expanded");
                                    $this.prev().css("max-height", expandHeight);
                                    $this.html("{{ __('messages.tampilkan_lebih_sedikit') }}");
                                }
                            });

                        </script>
                    </p>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Portfolio Details Section -->
