<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ config('app.name') }}</title>
    <meta content="{{ config('app.name') }}" name="description">
    <meta content="{{ config('app.name') }}" name="keywords">

    <!--favicon-->
    <link href="/favicon.ico" rel="icon">
    <link href="/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('app/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/bundles/izitoast/css/iziToast.min.css') }}">

</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-xl-5 mt-lg-2 mt-sm-2">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3 d-flex flex-column align-items-center">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('logo.png') }}" width="90" alt="Logo">
                                    </a>

                                    <h6 class="mt-3">Login SIAT-GAM</h6>

                                </div>


                                <form method="POST" action="{{ route('login.submit') }}">
                                    @csrf

                                    <!--email-->
                                    <x-input name="email" label="Email" type="email"
                                        value="{{ old('email') }}" />

                                    <!--password-->
                                    <x-input name="password" label="Password" type="password"
                                        value="{{ old('password') }}" />

                                    <!--btn login-->
                                    <x-button-primary class="btn-block btn-lg">
                                        Login
                                    </x-button-primary>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- js -->
    <script src="{{ asset('app/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('app/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('app/assets/js/custom.js') }}"></script>
    <script src="{{ asset('app/assets/bundles/izitoast/js/iziToast.min.js') }}"></script>

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

</body>

</html>
