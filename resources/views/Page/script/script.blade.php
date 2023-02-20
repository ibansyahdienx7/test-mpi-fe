<script type="text/javascript">
    new Swiper('.testimonials-slider', {
        speed: 600
        , loop: true
        , slidesPerView: 'auto'
        , autoplay: {
            delay: 3000
            , disableOnInteraction: false
        }
        , breakpoints: {
            320: {
                slidesPerView: 1
                , spaceBetween: 20
            },

            1200: {
                slidesPerView: 1
                , spaceBetween: 20
            }
        }
        , centeredSlides: true
        , scrollbar: {
            el: '.swiper-scrollbar'
            , draggable: true
        , }
        , freeMode: {
            enabled: true
            , sticky: true
        , }
        , parallax: true
        , navigation: {
            nextEl: '.swiper-button-next'
            , prevEl: '.swiper-button-prev'
        , }
    });

    new Swiper('.portfolio-details-slider', {
        speed: 600
        , loop: true
        , slidesPerView: 'auto'
        , autoplay: {
            delay: 3000
            , disableOnInteraction: false
        }
        , breakpoints: {
            320: {
                slidesPerView: 1
                , spaceBetween: 20
            },

            1200: {
                slidesPerView: 1
                , spaceBetween: 20
            }
        }
        , centeredSlides: true
        , scrollbar: {
            el: '.swiper-scrollbar'
            , draggable: true
        , }
        , freeMode: {
            enabled: true
            , sticky: true
        , }
        , parallax: true
        , navigation: {
            nextEl: '.swiper-button-next'
            , prevEl: '.swiper-button-prev'
        , }
        , pagination: {
            el: '.swiper-pagination'
            , type: 'bullets'
            , clickable: true
        }
    });

    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $(document).ready(function() {

        $("#floating_standard2").bind('keyup change', function() {

            check_Password($("#floating_standard").val(), $("#floating_standard2").val())


        })

        $("button").click(function() {

            check_Password($("#floating_standard").val(), $("#floating_standard2").val())

        });
    })

    function check_Password(Pass, Con_Pass) {

        if (Pass === "") {



        } else if (Pass === Con_Pass) {

            $(".cta-btn").prop('disabled', false);
            $('#alert-reset').hide()

        } else {
            $(".cta-btn").prop('disabled', true);
            $("#confirm_password").focus()
            $('#alert-reset').show()
            $("#alert-reset").html('<div class="alert alert-danger">{{ __("messages.kata_sandi_tidak_cocok") }}!</div>')

        }

    }

    $(".expand-toggle").click(function(e) {
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

<script type="text/javascript">
    // REALTIME //
    function load_data_footer() {
        $.ajax({
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: "{{ route('realtime.footer') }}"
            , type: "POST"
            , data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            }
            , dataType: "JSON"
            , success: function(resp_load_foot) {
                $('#footer_about').html(resp_load_foot.abouts);
                $(".expand-toggle").click(function(e) {
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

                if (resp_load_foot.status_payment == true) {
                    $('#list-payment').removeClass('d-none');
                    $('#list-payment').html(resp_load_foot.result_payment);
                } else {
                    $('#list-payment').addClass('d-none');
                }
            }
        });
    }

    load_data_footer();

    $('.cart-btn').on('click', function() {
        $.ajax({
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: "{{ route('realtime.cart') }}"
            , type: "POST"
            , data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            }
            , dataType: "JSON"
            , success: function(resp_load_cart) {
                $('#cart-list').html(resp_load_cart.result);
            }
        });
    });

    function load_data_banner() {
        $.ajax({
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: "{{ route('realtime.banner') }}"
            , type: "POST"
            , data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            }
            , dataType: "JSON"
            , success: function(resp_load_banner) {
                $('#list-banner').html(resp_load_banner.result);
            }
        });
    }

    load_data_banner();

    $(".expand-toggle").click(function(e) {
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
