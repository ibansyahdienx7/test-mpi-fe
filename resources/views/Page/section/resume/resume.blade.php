<!-- ======= Resume Section ======= -->
<section id="resume" class="resume">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Resume</h2>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h3 class="resume-title">Sumary</h3>
                <div class="resume-item pb-0">
                <h4>{{ $user->name ? $user->name : 'Unknown' }}</h4>
                <p>
                    <div class="full-width p-0 m-0">
                        <div class="page-width p-0 m-0">
                            <div class="expander p-0 m-0">
                                <div class="inner-bit p-0 m-0">
                                    <p class="text-left p-0 m-0">
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
                <p>
                <ul>
                    <li>{{ $kota }}</li>
                    <li>
                        <a href="{{ $profile->phone ? 'https://wa.me/' . str_replace("(62)", "62", str_replace(" ", "", str_replace("-", "", $profile->phone))) : 'javascript:void(0)' }}" target="_blank">
                            {{ $profile->phone ? $profile->phone : '-' }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ $user->email ? 'mailto:' . $user->email . '?subject=Halo%20' . $user->name : 'javascript:void(0)' }}" target="_blank">
                            {{ $user->email ? $user->email : '-' }}
                        </a>
                    </li>
                </ul>
                </p>
                </div>

                <h3 class="resume-title {{ $education_none }}">Education</h3>
                @php
                    echo $education;
                @endphp

                <h3 class="resume-title {{ $file_resume_none }}">{{ __('messages.unduh') }} Resume</h3>
                @php
                    echo $file_resume;
                @endphp
            </div>
            <div class="col-lg-6">
                <h3 class="resume-title {{ $experience_none }}">Professional Experience</h3>
                @php
                    echo $experience;
                @endphp
            </div>
        </div>

    </div>
</section><!-- End Resume Section -->
