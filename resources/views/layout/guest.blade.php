<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <meta content="{{ config('app.name') }}" name="description">
    <meta content="{{ config('app.name') }}" name="keywords">

    <!--favicon-->
    <link href="/favicon.ico" rel="icon">
    <link href="/apple-touch-icon.png" rel="apple-touch-icon">

    <!--font-->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap"
        rel="stylesheet">

    <!--css-->
    <link href="{{ asset('guest/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/assets/vendor/aos/aos.css" rel="stylesheet') }}">
    <link href="{{ asset('guest/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('app/assets/bundles/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">




    <!--style-->
    @stack('style')

</head>

<body>
    <!--header-->
    @include('partials.guest-header')

    <!--hero-->
    @isset($hero)
        {{ $hero }}
    @endisset


    <!--main-->
    <main id="main">
        {{ $slot }}
    </main>

    <!--footer-->
    @include('partials.guest-footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!--js-->
    <script src="{{ asset('guest/assets/js/main.js') }}"></script>
    <script src="{{ asset('guest/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('guest/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('guest/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('guest/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('guest/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('guest/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('guest/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('guest/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('app/assets/bundles/izitoast/js/iziToast.min.js') }}"></script>

    <!-- iziToast -->
    <script>
        @if (Session('error'))
            iziToast.error({
                message: '{{ session('error') }}',
                position: 'topRight'
            });
        @endif
    </script>

    <script>
        @if (Session('success'))
            iziToast.success({
                message: '{{ session('success') }}',
                position: 'topRight'
            });
        @endif
    </script>


    <!--script-->
    @stack('script')

</body>

</html>
