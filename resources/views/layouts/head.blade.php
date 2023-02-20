<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta content="@yield('description')" name="description">
<meta content="@yield('keyword')" name="keywords">
<meta name="google-site-verification" content="{{ config('app.keysite') }}" />

<meta name="robots" content="all,follow" />

<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="dcterms.type" content="website" />

<meta name="dcterms.language" content="{{ str_replace('_', '-', app()->getLocale()) }}" />

<link rel="canonical" href="{{ config('app.url') }}" />

<meta property="og:type" content="website" />

<meta property="og:title" content="@yield('title')" />

<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />

<meta property="og:site_name" content="@yield('title')">

<meta property="og:url" content="{{ config('app.url') }}" />

<meta name="apple-mobile-web-app-capable" content="yes" />

<meta content="yes" name="apple-touch-fullscreen" />

<meta name="identifier-URL" content="{{ config('app.url') }}" />

<meta name="language" content="{{ str_replace('_', '-', app()->getLocale()) }}" />

<meta name="classification" content="Business" />

<meta name="copyright" content="<?= date('Y'); ?> @yield('title')" />

<meta name="og:description" content="@yield('description')" />

<title>
    @yield('title')
</title>

<!-- FAVICON -->
<link href="{{ config('app.url') . '/favicon.ico' }}" type="image/ico" rel="shortcut icon">

<meta property="og:image" content="{{ config('app.url') . '/assets/template/assets/img/ibanlogo.png' }}" />

<link rel="apple-touch-icon" sizes="180x180" href="{{ config('app.url') . '/assets/template/assets/img/icon/apple-touch-icon.png' }}">

<link rel="icon" type="image/png" sizes="32x32" href="{{ config('app.url') . '/assets/template/assets/img/icon/favicon-32x32.png' }}">

<link rel="icon" type="image/png" sizes="16x16" href="{{ config('app.url') . '/assets/template/assets/img/icon/favicon-16x16.png' }}">

<link rel="icon" type="image/png" sizes="180x180" href="{{ config('app.url') . '/assets/template/assets/img/icon/apple-touch-icon.png' }}">
<link rel="icon" type="image/png" sizes="152x152" href="{{ config('app.url') . '/assets/template/assets/img/icon/apple-touch-icon.png' }}">
<link rel="icon" type="image/png" sizes="167x167" href="{{ config('app.url') . '/assets/template/assets/img/icon/apple-touch-icon.png' }}">
<link rel="icon" type="image/png" sizes="128x128" href="{{ config('app.url') . '/assets/template/assets/img/icon/apple-touch-icon.png' }}">
<link rel="icon" type="image/png" sizes="64x64" href="{{ config('app.url') . '/assets/template/assets/img/icon/apple-touch-icon.png' }}">
<link rel="icon" type="image/png" sizes="228x228" href="{{ config('app.url') . '/assets/template/assets/img/icon/apple-touch-icon.png' }}">
<link rel="icon" type="image/png" sizes="200x200" href="{{ config('app.url') . '/assets/template/assets/img/icon/apple-touch-icon.png' }}">
<link rel="icon" type="image/png" sizes="512x512" href="{{ config('app.url') . '/assets/template/assets/img/icon/android-chrome-512x512.png' }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ config('app.url') . '/assets/template/assets/img/icon/android-chrome-192x192.png' }}">

<link rel="manifest" href="{{ config('app.url') . '/assets/template/assets/img/icon/site.webmanifest' }}">

<meta name="msapplication-TileColor" content="{{ config('app.url') . '/assets/template/assets/img/ibanlogo.png' }}" />

<meta name="mobile-web-app-capable" content="yes">

<meta name="apple-mobile-web-app-capable" content="yes">

<meta name="application-name" content="@yield('title')">

<meta name="apple-mobile-web-app-title" content="@yield('title')">

<meta name="msapplication-navbutton-color" content="{{ config('app.color') }}">

<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<meta name="msapplication-starturl" content="{{ config('app.url') }}">

<meta name="msapplication-TileImage" content="{{ config('app.url') . '/assets/template/assets/img/ibanlogo.png' }}" />

<meta itemprop="image" content="{{ config('app.url') . '/assets/template/assets/img/ibanlogo.png' }}" />

<meta name="theme-color" content="{{ config('app.color') }}" />

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ config('app.url') . '/assets/template/assets/vendor/animate.css/animate.min.css' }}" rel="stylesheet">
<link href="{{ config('app.url') . '/assets/template/assets/vendor/aos/aos.css' }}" rel="stylesheet">
<link href="{{ config('app.url') . '/assets/template/assets/vendor/bootstrap/css/bootstrap.min.css' }}" rel="stylesheet">
<link href="{{ config('app.url') . '/assets/template/assets/vendor/bootstrap-icons/bootstrap-icons.css' }}" rel="stylesheet">
<link href="{{ config('app.url') . '/assets/template/assets/vendor/boxicons/css/boxicons.min.css' }}" rel="stylesheet">
<link href="{{ config('app.url') . '/assets/template/assets/vendor/glightbox/css/glightbox.min.css' }}" rel="stylesheet">
<link href="{{ config('app.url') . '/assets/template/assets/vendor/remixicon/remixicon.css' }}" rel="stylesheet">
<link href="{{ config('app.url') . '/assets/template/assets/vendor/swiper/swiper-bundle.min.css' }}" rel="stylesheet">
<link href="{{ config('app.url') . '/assets/vendor/swiper/swiper-bundle.min.css' }}" rel="stylesheet">
<link href="{{ config('app.url') . '/assets/vendor/drivertour/css/drivertour.min.css' }}" rel="stylesheet">

<!-- Select2 -->
<link rel="stylesheet" href="{{ config('app.url') . '/assets/vendor/select2/css/select2.min.css' }}">
<link rel="stylesheet" href="{{ config('app.url') . '/assets/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css' }}">

<!-- DataTables -->
<link rel="stylesheet" href="{{ config('app.url') . '/assets/template/assets/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css' }}">
<link rel="stylesheet" href="{{ config('app.url') . '/assets/template/assets/vendor/datatables-responsive/css/responsive.bootstrap4.min.css' }}">
<link rel="stylesheet" href="{{ config('app.url') . '/assets/template/assets/vendor/datatables-buttons/css/buttons.bootstrap4.min.css' }}">

<!-- templates Main CSS File -->
<link href="{{ config('app.url') . '/assets/template/assets/css/style.min.css' }}" rel="stylesheet">
<link href="{{ config('app.url') . '/assets/template/assets/css/tailwind.css' }}" rel="stylesheet">

<script src="{{ config('app.url') . '/assets/js/jquery-3.4.1.min.js' }}" type="text/javascript"></script>
{{-- <script src="{{ config('app.url') . '/assets/js/jquery-3.6.0.min.js' }}" type="text/javascript"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="{{ config('app.url') . '/assets/js/sweetalert.min.js' }}" type="text/javascript"></script>
<script src="{{ config('app.url') . '/assets/vendor/swal-alert/dist/sweetalert2.all.min.js' }}" type="text/javascript"></script>
<script src="{{ config('app.url') . '/assets/vendor/sweetalert2/sweetalert2.all.min.js' }}" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/aca8fe40b1.js" crossorigin="anonymous"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />

{{-- {!! RecaptchaV3::initJs() !!} --}}
