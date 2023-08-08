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

    <!--css-->
    <link rel="stylesheet" href="{{ asset('app/assets/bundles/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/bundles/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet"
        href="{{ asset('app/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/bundles/izitoast/css/iziToast.min.css') }}">


    <!--style-->
    @stack('style')

</head>

<body class="light dark-sidebar theme-white">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <!--navbar-->
            @include('partials.app-navbar')

            <!--sidebar-->
            @include('partials.app-sidebar')

            <!--main-->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        {{ $slot }}
                    </div>
                </section>

                <!-- modal-->
                @stack('modal')
            </div>

            <!--footer-->
            @include('partials.app-footer')

        </div>
    </div>

    <!--js-->
    <script src="{{ asset('app/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('app/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('app/assets/js/custom.js') }}"></script>
    <script src="{{ asset('app/assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('app/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app/assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('app/assets/bundles/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('app/assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('app/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('app/assets/bundles/summernote/summernote-bs4.js') }}"></script>


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
