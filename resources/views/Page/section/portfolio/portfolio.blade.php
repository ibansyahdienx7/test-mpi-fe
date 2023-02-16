<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

        @if (request()->routeIs('portfolio'))
            <div class="section-title">
                <h2>Portfolio</h2>
            </div>
        @endif

        @php
            echo $result_facts;
        @endphp

    </div>
</section><!-- End Portfolio Section -->
