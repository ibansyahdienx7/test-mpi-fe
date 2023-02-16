<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>{{ __('messages.about') }}</h2>
        </div>

        <div class="row">
            <div class="col-lg-4">
            <img src="{{ $user->profile_photo_path }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-8 pt-4 pt-lg-0 content">
                <h3>{{ $profile->job_title }}</h3>
                <p class="fst-italic">
                    #{{ __('messages.slogan') }}
                </p>
                <div class="row">
                    <div class="col-lg-6">
                    <ul>
                        <li><i class="bi bi-rounded-right"></i> <strong>{{ __('messages.full_name') }}:</strong> {{ $user->name ? $user->name : 'Unknown' }}</li>
                        <li><i class="bi bi-rounded-right"></i> <strong>Website:</strong> {{ $profile->website ? $profile->website : '-' }}</li>
                        <li><i class="bi bi-rounded-right"></i> <strong>Email:</strong> <a href="mailto:{{ $user->email }}?subject=Halo%20{{ $user->name }}" target="_blank">{{ $user->email }}</a></li>
                        <li><i class="bi bi-rounded-right"></i> <strong>{{ __('messages.kota') }}:</strong> {{ $kota }}</li>
                    </ul>
                    </div>
                    <div class="col-lg-6">
                    <ul>
                        <li><i class="bi bi-rounded-right"></i> <strong>{{ __('messages.degree') }}:</strong> {{ $gelar }}</li>
                        <li><i class="bi bi-rounded-right"></i> <strong>Skill:</strong> {{ $profile->skill }}</li>
                        <li><i class="bi bi-rounded-right"></i> <strong>Freelance / Open To Work:</strong> @php echo $profile->status_freelance == 1 ? '<span class="badge bg-success">' . __('messages.available') . '</span>' : '<span class="badge bg-danger">Close</span>' @endphp</li>
                    </ul>
                    </div>
                </div>
                <p>
                    <div class="full-width">
                        <div class="page-width">
                            <div class="expander">
                                <div class="inner-bit">
                                    <p class="text-left">
                                        @php echo $about; @endphp
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
</section><!-- End About Section -->

<!-- ======= Skills Section ======= -->
<section id="skills" class="skills">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Skills</h2>
        </div>

        @php
            echo $skill;
        @endphp

    </div>
</section><!-- End Skills Section -->

<!-- ======= Facts Section ======= -->
<section id="facts" class="facts">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Facts</h2>
        </div>

        <div class="row counters justify-content-center">

            <div class="col-lg-3 col-6 text-center">
                <span data-purecounter-start="0" data-purecounter-end="{{ $count_client }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Clients</p>
            </div>

            <div class="col-lg-3 col-6 text-center">
                <span data-purecounter-start="0" data-purecounter-end="{{ $count_project }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Projects</p>
            </div>

            <div class="col-lg-3 col-6 text-center">
                <span class="support">10:00 AM - 18:00 PM</span>
                <p class="support-text">{{ __('messages.jam_dukungan') }}</p>
            </div>

        </div>

    </div>
</section><!-- End Facts Section -->

@include('Page.section.portfolio.portfolio')

@include('Page.section.testi.testi')
