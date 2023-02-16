@if(request()->routeIs('index'))
    <style type="text/css">
        .driver-close-btn{
            display: none !important;
        }
    </style>

    <script type="text/javascript">
        // var tourguide = new Tourguide();
        // tourguide.start();

        const driver = new Driver({
            className: 'scoped-class', // className to wrap driver.js popover
            animate: true,  // Animate while changing highlighted element
            opacity: 0.47,  // Background opacity (0 means only popovers and without overlay)
            padding: 5,    // Distance of element from around the edges
            allowClose: false, // Whether clicking on overlay should close or not
            responsive: true,
            overlayClickNext: false, // Should it move to next step on overlay click
            overlayScrollIntoView:false,
            doneBtnText: 'Done', // Text on the final button
            closeBtnText: 'Close', // Text on the close button for this step
            nextBtnText: 'Next', // Next button text for this step
            prevBtnText: 'Previous', // Previous button text for this step
            showButtons: true, // Do not show control buttons in footer
            keyboardControl: false, // Allow controlling through keyboard (escape to close, arrow keys to move)
            scrollIntoViewOptions: {},
            onNext: (Element) => {},      // Called when moving to next step on any step
            onPrevious: (Element) => {},  // Called when moving to next step on any step
        });

        function AksesDesktop(xa) {
            if (xa.matches) { // If media query matches
                // Define the steps for introduction
                driver.defineSteps([
                    {
                        element: '.step_start',
                        popover: {
                            className: 'popover-class',
                            title: 'Ayoscan Merchant',
                            description: '{{ __("messages.welcome") }} Ayoscan Merchant, {{ __("messages.follow_tour") }}',
                            position: 'bottom',
                        },
                        nextBtnText: 'Start Tour',
                    },
                    {
                        element: '#step_1',
                        popover: {
                            title: 'Partner With Us',
                            description: '{{ __("messages.step_merchant") }}',
                            position: 'bottom',
                        },
                        nextBtnText: 'Next',
                    },
                    // {
                    //     element: '.step_2',
                    //     popover: {
                    //         title: "{{ __('messages.product') }}",
                    //         description: '{{ __("messages.step_product") }}',
                    //         position: 'bottom'
                    //     },
                    //     nextBtnText: "Next",
                    // },
                    {
                        element: '.step_3',
                        popover: {
                            title: "{{ __('messages.information') }}",
                            description: '{{ __("messages.step_information") }}',
                            position: 'bottom',
                        },
                        nextBtnText: 'Next',
                    },
                    {
                        element: '.step_4',
                        popover: {
                            title: "{{ __('messages.contact') }}",
                            description: '{{ __("messages.step_help") }}',
                            position: 'bottom'
                        },
                        nextBtnText: 'Next',
                    },
                    {
                        element: '.step_5',
                        popover: {
                            title: "{{ __('messages.login') }}",
                            description: '{{ __("messages.step_login") }}',
                            position: 'left'
                        },
                        nextBtnText: 'Next',
                    },
                    {
                        element: '.step_6',
                        popover: {
                            title: "{{ __('messages.registrasi') }}",
                            description: '{{ __("messages.pendaftaran_tutor") }}',
                            position: 'left'
                        },
                        nextBtnText: 'Next',
                    },
                    {
                        element: '.step_7',
                        popover: {
                            title: 'Download App',
                            description: '{{ __("messages.download_app_desk") }}',
                            position: 'top'
                        },
                        nextBtnText: 'Next',
                    },

                    {
                        element: '.step_8',
                        popover: {
                            title: "{{ __('messages.title_tutor_reg') }}",
                            description: '{{ __("messages.desc_tutors_head") }}',
                            position: 'bottom-center'
                        },
                        onNext: () => {
                            // Prevent moving to the next step
                            driver.preventMove();

                            // Perform some action or create the element to move to
                            // And then move to that element
                            setCookie('cookie_tour_ayoscan', 1, 30);
                            driver.moveNext();
                        },
                        nextBtnText: 'Next',
                    },

                    {
                        element: '.step_9',
                        popover: {
                            title: "{{ __('messages.payment_method') }}",
                            description: '{{ __("messages.step_pembayaran") }}',
                            position: 'bottom-center'
                        },
                        nextBtnText: 'Finish',
                    },
                ]);

                // Create cookie
                function setCookie(cname, cvalue, exdays) {
                    const d = new Date();
                    d.setTime(d.getTime() + (exdays*24*60*60*1000));
                    let expires = "expires="+ d.toUTCString();
                    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }

                // Delete cookie
                function deleteCookie(cname) {
                    const d = new Date();
                    d.setTime(d.getTime() + (24*60*60*1000));
                    let expires = "expires="+ d.toUTCString();
                    document.cookie = cname + "=;" + expires + ";path=/";
                }

                // Read cookie
                function getCookie(cname) {
                    let name = cname + "=";
                    let decodedCookie = decodeURIComponent(document.cookie);
                    let ca = decodedCookie.split(';');
                    for(let i = 0; i <ca.length; i++) {
                        let c = ca[i];
                        while (c.charAt(0) == ' ') {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                }

                if(localStorage.getItem('eucookie') == 'cookie_tour_ayoscan'){
                    localStorage.setItem('eucookie','cookie_tour_ayoscan');
                }

                let cookie_consent_tour = getCookie("cookie_tour_ayoscan");
                if(cookie_consent_tour == ""){
                    driver.start();
                }
            }
        }

        var xa = window.matchMedia("(min-width: 993px)")
        AksesDesktop(xa) // Call listener function at run time
        xa.addListener(AksesDesktop) // Attach listener function on state changes

        function AksesMobile(xm) {
            if (xm.matches) { // If media query matches
                // Define the steps for introduction
                driver.defineSteps([
                    {
                        element: '.step_start',
                        popover: {
                            className: 'popover-class',
                            title: 'Ayoscan Merchant',
                            description: '{{ __("messages.welcome") }} Ayoscan Merchant, {{ __("messages.follow_tour") }}',
                            position: 'bottom',
                        },
                        nextBtnText: 'Start Tour',
                    },
                    {
                        element: '.step_mobile',
                        popover: {
                            title: 'Menu',
                            description: '{{ __("messages.menu_open") }}',
                            position: 'left'
                        },
                        nextBtnText: 'Next',
                    },
                    {
                        element: '.step_7',
                        popover: {
                            title: 'Download App',
                            description: '{{ __("messages.download_app_desk") }}',
                            position: 'top'
                        },
                        nextBtnText: 'Next',
                    },
                    {
                        element: '.step_8',
                        popover: {
                            title: "{{ __('messages.title_tutor_reg') }}",
                            description: '{{ __("messages.desc_tutors_head") }}',
                            position: 'bottom-center'
                        },
                        onNext: () => {
                            // Prevent moving to the next step
                            driver.preventMove();

                            // Perform some action or create the element to move to
                            // And then move to that element
                            setCookie('cookie_tour_ayoscan', 1, 30);
                            driver.moveNext();
                        },
                        nextBtnText: 'Next',
                    },

                    {
                        element: '.step_9',
                        popover: {
                            title: "{{ __('messages.payment_method') }}",
                            description: '{{ __("messages.step_pembayaran") }}',
                            position: 'bottom-center'
                        },
                        nextBtnText: 'Finish',
                    },
                ]);

                $('.mobile-nav-toggle').on('click', function(){
                    driver.defineSteps([
                        {
                            element: '#step_1',
                            popover: {
                                title: 'Partner With Us',
                                description: '{{ __("messages.step_merchant") }}',
                                position: 'bottom',
                            },
                            nextBtnText: 'Next',
                        },
                        // {
                        //     element: '.step_2',
                        //     popover: {
                        //         title: "{{ __('messages.product') }}",
                        //         description: '{{ __("messages.step_product") }}',
                        //         position: 'bottom'
                        //     },
                        //     nextBtnText: "Next",
                        // },
                        {
                            element: '.step_3',
                            popover: {
                                title: "{{ __('messages.information') }}",
                                description: '{{ __("messages.step_information") }}',
                                position: 'bottom',
                            },
                            nextBtnText: 'Next',
                        },
                        {
                            element: '.step_4',
                            popover: {
                                title: "{{ __('messages.contact') }}",
                                description: '{{ __("messages.step_help") }}',
                                position: 'bottom'
                            },
                            nextBtnText: 'Next',
                        },
                        {
                            element: '.step_5',
                            popover: {
                                title: "{{ __('messages.login') }}",
                                description: '{{ __("messages.step_login") }}',
                                position: 'left'
                            },
                            onNext: () => {
                                // Prevent moving to the next step
                                driver.preventMove();

                                // Perform some action or create the element to move to
                                // And then move to that element
                                setCookie('cookie_tour_ayoscan', 1, 30);
                                driver.moveNext();
                            },
                            nextBtnText: 'Next',
                        },
                        {
                            element: '.step_6',
                            popover: {
                                title: "{{ __('messages.registrasi') }}",
                                description: '{{ __("messages.pendaftaran_tutor") }}',
                                position: 'left'
                            },
                            nextBtnText: 'Next',
                        },
                    ]);
                });

                // Create cookie
                function setCookie(cname, cvalue, exdays) {
                    const d = new Date();
                    d.setTime(d.getTime() + (exdays*24*60*60*1000));
                    let expires = "expires="+ d.toUTCString();
                    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }

                // Delete cookie
                function deleteCookie(cname) {
                    const d = new Date();
                    d.setTime(d.getTime() + (24*60*60*1000));
                    let expires = "expires="+ d.toUTCString();
                    document.cookie = cname + "=;" + expires + ";path=/";
                }

                // Read cookie
                function getCookie(cname) {
                    let name = cname + "=";
                    let decodedCookie = decodeURIComponent(document.cookie);
                    let ca = decodedCookie.split(';');
                    for(let i = 0; i <ca.length; i++) {
                        let c = ca[i];
                        while (c.charAt(0) == ' ') {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                }

                if(localStorage.getItem('eucookie') == 'cookie_tour_ayoscan'){
                    localStorage.setItem('eucookie','cookie_tour_ayoscan');
                }

                let cookie_consent_tour = getCookie("cookie_tour_ayoscan");
                if(cookie_consent_tour == ""){
                    driver.start();
                }
            }
        }

        var xm = window.matchMedia("(max-width: 992px)")
        AksesMobile(xm) // Call listener function at run time
        xm.addListener(AksesMobile) // Attach listener function on state changes
    </script>
@endif
