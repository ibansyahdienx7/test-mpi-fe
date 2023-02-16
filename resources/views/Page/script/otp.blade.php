<script type="text/javascript">
    $('.sendOtp').attr('disabled', true);
    $('#otp-number-input-1').focus();
    /** OTP Input **/

    $(".otp-number-input").keydown(function(ev) {
    otp_val = $(this).val();
    if (ev.keyCode == 37) {
        $(this).prev('.otp-number-input').focus();
        ev.preventDefault();
    } else if (ev.keyCode == 39) {
        $(this).next('.otp-number-input').focus();
        ev.preventDefault();
    } else if (otp_val.length == 1 && ev.keyCode != 8 && ev.keyCode != 46) {
        otp_next_number = $(this).next('.otp-number-input');
        if (otp_next_number.length == 1 && otp_next_number.val().length == 0) {
            otp_next_number.focus();
        }
    } else if (otp_val.length == 0 && ev.keyCode == 8) {
        $(this).prev('.otp-number-input').val("");
        $(this).prev('.otp-number-input').focus();
    } else if (otp_val.length == 1 && ev.keyCode == 8) {
        $(this).val("");
    } else if (otp_val.length == 0 && ev.keyCode == 46) {
        next_input = $(this).next('.otp-number-input');
        next_input.val("");
        while (next_input.next('.otp-number-input').length > 0) {
            next_input.val(next_input.next('.otp-number-input').val());
            next_input = next_input.next('.otp-number-input');
            if (next_input.next('.otp-number-input').length == 0) {
                next_input.val("");
                break;
            }
        }
    }
    $('#code-error').addClass('invisible');
    $('#code-clear').addClass('none');

   }).focus(function() {
        $(this).select();
   }).keyup(function(ev) {
        otpCodeTemp = "";
        $("input.otp-number-input").each(function(i) {
            if ($(this).val().length != 0) {
                $(this).addClass('otp-filled-active');
            } else {
                $(this).removeClass('otp-filled-active');
            }
            otpCodeTemp += $(this).val();
        });

        if ($(this).val().length ==1 && ev.keyCode != 37 && ev.keyCode != 39) {
            $(this).next('.otp-number-input').focus();
            ev.preventDefault();
        }else {
            $('.sendOtp').attr('disabled', true);
        }
    });
    $(".otp-number-input").on("click", function(e) {
        otp_val = $('#otp-number-input-1').val();
        if (otp_val === "") {
            $("#otp-number-input-1").focus();
        }
    });
    $(".otp-number-input").on("paste", function(e) {
        //window.handlePasteOTP(e);
        e.preventDefault();
    });


    $('.otp-number-input').on('focusout', function(){
        var $allInput;
        if($(this).val().length){
            $allInput = $('.otp-number-input').map(function(idx, elem) {
                return $(elem).val();
            }).get().join('');
        }
        // console.log($allInput);
        $('#resultOtp').val($allInput);
	    $(this).parents('.form-group').find('.input-error').hide();
        /*if($('#txtOTP').val().length < 6){
            $(this).parents('.form-group').find('.input-error').show();
        }else{
            $(this).parents('.form-group').find('.input-error').hide();
        }*/

    });

    $('#otp-number-input-6').on('keyup', function(){
        if($(this).val().length == 1) {
            $('.sendOtp').attr('disabled', false);
        }
    });

    /** OTP Input **/

    $('.spinner-border').addClass('hidden');

    $('.sendOtp').on('click', function(){
        var resultOtps       = $('#resultOtp').val();
        var emailMerchant   = $('#emailMerchant').val();
        var otpWaktu        = $('#waktuOtp').val();

        if(resultOtps == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oopss ... !!',
                html: 'Code cannot be empty',
                showConfirmButton: false,
                timer: 1500
            });
            $('.sendOtp').attr('disabled', true);
        } else if(emailMerchant == '')
        {
            Swal.fire({
                icon: 'error',
                title: 'Oopss ... !!',
                html: 'Email unknown',
                showConfirmButton: false,
                timer: 1500
            })

            $('.sendOtp').attr('disabled', true);
        } else {

            $('.sendOtp').attr('disabled', false);
            $('.spinner-border').removeClass('hidden');
            $('.sendOtp').text('Please wait a minutes ...');

            $.ajax({
                header:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route('otp.post') }}",
                method:"GET",
                beforeSend: function()
                {

                    $('.spinner-border').removeClass('hidden');
                    $('.sendOtp').text('Please wait a minutes ...');

                },
                complete: function()
                {
                    $('.spinner-border').addClass('hidden');
                },
                data:{
                    "otp"       :   resultOtps,
                    "email"     :   emailMerchant,
                    // "waktu"     :   otpWaktu,
                    "_token"    :   $('meta[name="csrf-token"]').attr('content')
                },
                dataType:"JSON",
                success:function(resp_otp)
                {
                    if(resp_otp.status  == true)
                    {
                        var timeleft = 5;
                        var downloadTimer = setInterval(function(){

                            if(timeleft <= 1){

                                // setTimeout(() => {
                                //     Swal.fire({
                                //         icon: 'success',
                                //         title: 'Success Validation',
                                //         html: '{{ __("messages.halaman_alihkan") }}',
                                //         showConfirmButton: false,
                                //         timer: 1500
                                //     });
                                // }, 1000);

                                setTimeout(() => {
                                    window.location.href='{{ route("login") }}';
                                    // window.close();
                                }, 2000);
                            }

                            $('.spinner-border').addClass('hidden');
                            $('.sendOtp').html('{{ __("messages.tutup_halaman") }} <span class="text-danger">' + timeleft + '</span>');
                            $('.sendOtp').attr("disabled", true);
                            $('.sendOtp').addClass('bg-dark').removeClass('bg-danger');

                            timeleft -= 1;
                        }, 1000);

                    } else {
                        $('.sendOtp').addClass('bg-danger');
                        $('.sendOtp').html(resp_otp.msg);
                        $('.sendOtp').attr("disabled", true);
                        $('.spinner-border').addClass('hidden');

                        setTimeout(() => {
                            $('.sendOtp').addClass('bg-success').removeClass('bg-danger');
                            $('.sendOtp').html('Validate');
                            $('.sendOtp').attr("disabled", false);
                        }, 3000);

                        $("#codeBox1").prop('disabled', false);
                        $("#codeBox2").prop('disabled', false);
                        $("#codeBox3").prop('disabled', false);
                        $("#codeBox4").prop('disabled', false);
                        $("#codeBox5").prop('disabled', false);
                        $("#codeBox6").prop('disabled', false);

                        $("#codeBox1").val('');
                        $("#codeBox2").val('');
                        $("#codeBox3").val('');
                        $("#codeBox4").val('');
                        $("#codeBox5").val('');
                        $("#codeBox6").val('');

                    }
                },
                error: function()
                {
                    $('.sendOtp').addClass('bg-danger');
                    $('.sendOtp').html('Error!');
                    $('.sendOtp').attr("disabled", true);
                    $('.spinner-border').addClass('hidden');

                    setTimeout(() => {
                        $('.sendOtp').addClass('bg-success').removeClass('bg-danger');
                        $('.sendOtp').html('Validate');
                        $('.sendOtp').attr("disabled", false);
                    }, 3000);

                    $("#codeBox1").prop('disabled', false);
                    $("#codeBox2").prop('disabled', false);
                    $("#codeBox3").prop('disabled', false);
                    $("#codeBox4").prop('disabled', false);
                    $("#codeBox5").prop('disabled', false);
                    $("#codeBox6").prop('disabled', false);

                    $("#codeBox1").val('');
                    $("#codeBox2").val('');
                    $("#codeBox3").val('');
                    $("#codeBox4").val('');
                    $("#codeBox5").val('');
                    $("#codeBox6").val('');
                }
            });
        }
    });

    var x = setInterval(function() {
        var waktu = $('#waktuOtp').val();
        var countDownDate = new Date(waktu).getTime();
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        if(seconds < 10){
            $('#demo').html('<a href="javascript:void(0)" class="timeer text-danger"><strong>' + minutes + ':0' + seconds + ' </strong></a>');
        }else {
            $('#demo').html('<a href="javascript:void(0)" class="timeer text-danger"><strong>' + minutes + ':' + seconds + ' </strong></a>');
        }
        if(distance < 1){
            // clearInterval(x);
            $('#demo').html('<a href="javascript:void(0)" id="demo" class="resend text-danger" data-usremail="' + $('#emailMerchant').val() + '" onclick="newcode()">{{ __("messages.send_otp_ulang") }}</a>');
        }
    }, 1000);

    function newcode(){

        var usremail = event.currentTarget.dataset.usremail;

        $.ajax({
            header:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ route('otp.resend') }}",
            data: {
                "merchantEmail"     :   usremail,
                "_token"            :   $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "JSON",
            beforeSend: function()
            {
                $('#demo').text('Please wait a minute ...');
                $('#demo').addClass('text-danger');
            },
            success: function(dataotp){
                if(dataotp.status == 200){

                    $('#waktuOtp').val(dataotp.waktu);
                    $('.resend').hide();
                    $('.timeer').fadeIn();

                    Swal.fire({
                        icon: 'info',
                        title: '{{ __("messages.kode_verif") }}',
                        html: '{{ __("messages.otp_resend_new") }} ',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $("#codeBox1").prop('disabled', false);
                    $("#codeBox2").prop('disabled', false);
                    $("#codeBox3").prop('disabled', false);
                    $("#codeBox4").prop('disabled', false);
                    $("#codeBox5").prop('disabled', false);
                    $("#codeBox6").prop('disabled', false);

                    $("#codeBox1").val('');
                    $("#codeBox2").val('');
                    $("#codeBox3").val('');
                    $("#codeBox4").val('');
                    $("#codeBox5").val('');
                    $("#codeBox6").val('');

                } else if(dataotp.status == 500)
                {
                    Swal.fire({
                        icon: 'info',
                        title: '{{ __("messages.kode_verif") }}',
                        html: '{{ __("messages.new_otp") }} ' + dataotp.tanggal,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('.resend').fadeIn();
                    $('.timeer').fadeOut();

                    $("#codeBox1").prop('disabled', false);
                    $("#codeBox2").prop('disabled', false);
                    $("#codeBox3").prop('disabled', false);
                    $("#codeBox4").prop('disabled', false);
                    $("#codeBox5").prop('disabled', false);
                    $("#codeBox6").prop('disabled', false);

                    $("#codeBox1").val('');
                    $("#codeBox2").val('');
                    $("#codeBox3").val('');
                    $("#codeBox4").val('');
                    $("#codeBox5").val('');
                    $("#codeBox6").val('');
                }

            }
        });

        return false;
    };
</script>
