<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Str dashboard --}}
    <link rel="stylesheet" href="{{ asset('str_dash/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/slicknav.min.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('str_dash/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ asset('str_dash/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>
<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div id="app">
       @include('inc/sidebar')
       @include('inc/navbar')
            <div class="main-content-inner">
                @yield('content')
            </div>
    </div>
    <script src="{{ asset('str_dash/js/vendor/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('str_dash/js/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('str_dash/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('str_dash/js/owl.carousel.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('str_dash/js/metisMenu.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('str_dash/js/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('str_dash/js/jquery.slicknav.min.js')}}" type="text/javascript"></script>

    <!-- others plugins -->
    <script src="{{ asset('str_dash/js/plugins.js') }}"></script>
    <script src="{{ asset('str_dash/js/scripts.js')}}"></script>
    @include('inc/footer')
</body>
</html>
