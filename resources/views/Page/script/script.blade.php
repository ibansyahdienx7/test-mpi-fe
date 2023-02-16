<script type="text/javascript">
new Swiper('.testimonials-slider', {
    speed: 600,
    loop: true,
    slidesPerView: 'auto',
    autoplay: {
        delay: 3000,
        disableOnInteraction: false
    },
    breakpoints: {
        320: {
        slidesPerView: 1,
        spaceBetween: 20
        },

        1200: {
        slidesPerView: 1,
        spaceBetween: 20
        }
    },
    centeredSlides: true,
    scrollbar: {
        el: '.swiper-scrollbar',
        draggable: true,
    },
    freeMode: {
        enabled: true,
        sticky: true,
    },
    parallax: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    }
});

new Swiper('.portfolio-details-slider', {
    speed: 600,
    loop: true,
    slidesPerView: 'auto',
    autoplay: {
        delay: 3000,
        disableOnInteraction: false
    },
    breakpoints: {
        320: {
        slidesPerView: 1,
        spaceBetween: 20
        },

        1200: {
        slidesPerView: 1,
        spaceBetween: 20
        }
    },
    centeredSlides: true,
    scrollbar: {
        el: '.swiper-scrollbar',
        draggable: true,
    },
    freeMode: {
        enabled: true,
        sticky: true,
    },
    parallax: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
});
</script>
