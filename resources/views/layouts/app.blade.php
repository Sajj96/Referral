<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css')}}">
    @section('general-css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-social/bootstrap-social.css')}}">
    @show
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('assets/img/favicon.ico')}}" />
</head>
<body>
    <div id="app">
        <main class="py-4">
            @include('flash-message')
            @yield('content')
        </main>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/app.min.js')}}"></script>
    <!-- JS Libraries -->
    @section('js-libraries')
    @show
    <!-- Page Specific JS File -->
    @section('page-specific-js')
    @show
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js')}}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets/js/custom.js')}}"></script>
</body>
</html>
