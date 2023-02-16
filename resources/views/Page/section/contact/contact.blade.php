<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
        <h2>{{ __('messages.kontak_kami') }}</h2>
        </div>

        <div>
            <div id="maps"></div>
        </div>

        <div class="row mt-5">

        <div class="col-lg-4">
            <div class="info">
            <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>{{ __('messages.lokasi') }}</h4>
                <p id="hasil-alamat"></p>
            </div>

            <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email</h4>
                <p>
                    <a href="mailto:ibansyahdienx7@gmail.com?subject=Halo%20{{ config('app.brand') }}" target="_blank">
                        ibansyahdienx7@gmail.com
                    </a>
                </p>
            </div>

            <div class="phone">
                <i class='bx bxl-whatsapp'></i>
                <h4>Whatsapp</h4>
                <p>
                    <a href="https://wa.me/6281293820960" target="_blank" class="btn btn-primary btn-sm">
                        {{ __('messages.kontak_kami') }} {{ config('app.brand') }}
                    </a>
                </p>
            </div>

            </div>

        </div>

        <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="{{ route('contact.send') }}" method="POST" role="form" class="php-email-form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('messages.full_name') }}" required />
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required />
                    </div>
                </div>
                <div class="form-group mt-3">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required />
                </div>
                <div class="form-group mt-3">
                    <textarea class="form-control" name="message" rows="5" placeholder="{{ __('messages.pesans') }}" required></textarea>
                </div>
                <div class="my-3">
                    <div class="loading">Loading . . .</div>
                    <div class="error-message"></div>
                    <div class="sent-message">{{ __('messages.pesan_berhasil') }}</div>
                </div>
                <div class="text-center"><button type="submit">{{ __('messages.btn_contact') }}</button></div>
            </form>

        </div>

        </div>

    </div>
</section><!-- End Contact Section -->

<input type="hidden" class="form-control" name="lat" id="lat" value="-6.363528117714598" readonly />
<input type="hidden" class="form-control" name="long" id="lng" value="106.87127756840056" readonly />
<input type="hidden" class="form-control" id="cari-alamat" value="Jl. Tipar Sari Blok Alternatif No.54, RT.2/RW.8, Mekarsari, Kec. Cimanggis, Kota Depok, Jawa Barat 16452" readonly />
<!-- ================================================= GOOGLE MAPS ======================================================== -->
<script type="text/javascript">
    function Init(){
        var info_window = new google.maps.InfoWindow();
        var zoom = 12;
        var options = {
            'zoom': zoom,
            'mapTypeId': google.maps.MapTypeId.ROADMAP,
        };

        var map = new google.maps.Map(document.getElementById('maps'), options);
        info_window = new google.maps.InfoWindow({
            'content': 'Loading . . .'
        });
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                initialLocation = new google.maps.LatLng($('[name="lat"]').val(), $('[name="long"]').val());
                map.setCenter(initialLocation);
                var latlon = new google.maps.LatLng($('[name="lat"]').val(), $('[name="long"]').val());
                $('[name="lat"]').val(position.coords.latitude);
                $('[name="long"]').val(position.coords.longitude);
                document.getElementById('lat').innerHTML = position.coords.latitude;
                document.getElementById('lng').innerHTML = position.coords.longitude;
                var marker = new google.maps.Marker({
                    position:latlon,
                    map:map,
                    title:"{{ config('app.brand') }}",
                    animation:google.maps.Animation.BOUNCE,
                    draggable: true,
                });

                // info alamat
                convert_latlng(marker.getPosition());

                // menambahkan event drag ketika marker di geser
                google.maps.event.addListener(marker, 'dragstart', function(e){
                    // info lat lng
                    $('[name="lat"]').val(e.latLng.lat());
                    $('[name="long"]').val(e.latLng.lng());
                    document.getElementById('lat').innerHTML = e.latLng.lat();
                    document.getElementById('lng').innerHTML = e.latLng.lng();

                    // info alamat
                    convert_latlng(marker.getPosition());
                });
            });
        }
    }

    function cari_alamat(){
        var alamatadr = document.getElementById('cari-alamat').value;

        // membuat geocoder
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode(
            {
                'address': alamatadr
            },
            function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var info_window = new google.maps.InfoWindow();

                    // mendapatkan lokasi koordinat
                    var geo = results[0].geometry.location;

                    // set koordinat
                    var pos = new google.maps.LatLng(geo.lat(),geo.lng());

                    // update lokasi saat ini
                    posisi_marker(pos);

                    // rubah lokasi saat ini menjadi alamat
                    convert_latlng(pos);

                    // opsi peta yang akan di tampilkan
                    var option = {
                        center: pos,
                        zoom: 16,
                        mapTypeId:google.maps.MapTypeId.ROADMAP
                    };

                    // membuat peta
                    var map = new google.maps.Map(document.getElementById('maps'),option);
                        info_window = new google.maps.InfoWindow({
                        content: 'Loading . . .'
                    });

                    // menambahkan marker pada peta
                    // agar marker bisa di drag maka anda perlu menambahkan object draggable
                    var marker = new google.maps.Marker({
                        position: pos,
                        title: '{{ config("app.brand") }}',
                        animation:google.maps.Animation.BOUNCE,
                        draggable: true
                    });
                    marker.setMap(map);

                    // menambahkan event drag ketika marker di geser
                    google.maps.event.addListener(marker, 'dragstart', function(e){
                        // info lat lng
                        $('[name="lat"]').val(e.latLng.lat());
                        $('[name="long"]').val(e.latLng.lng());
                        document.getElementById('lat').innerHTML = e.latLng.lat();
                        document.getElementById('lng').innerHTML = e.latLng.lng();

                        // info alamat
                        convert_latlng(marker.getPosition());
                    });

                    // menambahkan event click ketika marker di klik
                    google.maps.event.addListener(marker, 'click', function () {
                        info_window.setContent('<b>'+ this.title +'</b>');
                        info_window.open(map, this);

                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Oopss !!',
                        html: '{{ __("messages.lokasi_404") }}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        );
    }

    var inputadr = document.getElementById("cari-alamat");
    inputadr.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            // mengambil isi dari textarea dengan id alamat
            var alamatadr = document.getElementById('cari-alamat').value;
            // membuat geocoder
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode(
                {
                    'address': alamatadr
                },
                function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var info_window = new google.maps.InfoWindow();

                        // mendapatkan lokasi koordinat
                        var geo = results[0].geometry.location;

                        // set koordinat
                        var pos = new google.maps.LatLng(geo.lat(),geo.lng());

                        // update lokasi saat ini
                        posisi_marker(pos);

                        // rubah lokasi saat ini menjadi alamat
                        convert_latlng(pos);

                        // opsi peta yang akan di tampilkan
                        var option = {
                            center: pos,
                            zoom: 16,
                            mapTypeId:google.maps.MapTypeId.ROADMAP
                        };

                        // membuat peta
                        var map = new google.maps.Map(document.getElementById('maps'),option);
                            info_window = new google.maps.InfoWindow({
                            content: 'Loading . . .'
                        });

                        // menambahkan marker pada peta
                        // agar marker bisa di drag maka anda perlu menambahkan object draggable
                        var marker = new google.maps.Marker({
                            position: pos,
                            title: '{{ config("app.brand") }}',
                            animation:google.maps.Animation.BOUNCE,
                            draggable: true
                        });
                        marker.setMap(map);

                        // menambahkan event drag ketika marker di geser
                        google.maps.event.addListener(marker, 'dragstart', function(e){
                            // info lat lng
                            document.getElementById('lat').innerHTML = e.latLng.lat();
                            document.getElementById('lng').innerHTML = e.latLng.lng();
                            $('[name="lat"]').val(e.latLng.lat());
                            $('[name="long"]').val(e.latLng.lng());

                            // info alamat
                            convert_latlng(marker.getPosition());
                        });

                        // menambahkan event click ketika marker di klik
                        google.maps.event.addListener(marker, 'click', function () {
                            info_window.setContent('<b>'+ this.title +'</b>');
                            info_window.open(map, this);
                        });

                    } else {

                        Swal.fire({
                            icon: 'info',
                            title: 'Oopss !!',
                            html: '{{ __("messages.lokasi_404") }}',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            );
        }
    });

    // menentukan posisi marker
    function posisi_marker(pos) {
        // menampilkan latitude dan longitude pada id lat dan lng
        document.getElementById('lat').innerHTML = pos.lat();
        document.getElementById('lng').innerHTML = pos.lng();
        $('[name="lat"]').val(pos.lat());
        $('[name="long"]').val(pos.lng());
    }

    // merubah geotag menjadi alamat
    function convert_latlng(pos) {

        // membuat geocoder
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'latLng': pos}, function(r) {

            if (r && r.length > 0) {
                $('#info-alamat').html(r[0].formatted_address);
                // document.getElementById('info-alamat').innerHTML = r[0].formatted_address;
                // document.getElementById('hasil-alamat').innerHTML = r[0].formatted_address;
            } else {
                // document.getElementById('info-alamat').innerHTML = '{{ __("messages.tidak_ditemukan_map") }}';
                $('#info-alamat').html('{{ __("messages.tidak_ditemukan_map") }}');
            }

        });
    }

    $('#hasil-alamat').html($("#cari-alamat").val());
</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdLwrkfOQNzH5Yk6yE-QiegJisSMbXzf8&callback=Init"></script>
