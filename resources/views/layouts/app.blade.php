<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @auth
    <script>
        window.user = @json(auth()->user())
    </script>
    @endauth

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ewallet.css') }}" rel="stylesheet">
    {{-- Str dashboard --}}
    {{-- <link rel="stylesheet" href="{{ asset('str_dash/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/slicknav.min.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('data_table/css/dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('data_table/css/bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('data_table/css/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('data_table/css/responsive.jqueryui.min.css') }}">
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('str_dash/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('str_dash/css/responsive.css') }}"> --}}
    <!-- modernizr css -->
    <script src="{{ asset('str_dash/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>
<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div id="app">
      @if(auth::check())
       @include('inc/sidebar')
       <Navbar></Navbar>
      @endif
     <div class="main-content-inner" id="main-content">
        <router-view></router-view>
         <!-- set progressbar -->
         <vue-progress-bar></vue-progress-bar>
     </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/ewallet.js') }}" type="application/javascript"></script>
    {{-- <!-- Scripts -->
    <script src="{{ asset('str_dash/js/vendor/jquery-2.2.4.min.js')}}" type="application/javascript"></script>
    <script src="{{ asset('str_dash/js/popper.min.js') }}" type="application/javascript"></script>
    <script src="{{ asset('str_dash/js/bootstrap.min.js') }}" type="application/javascript"></script>
    <script src="{{ asset('str_dash/js/owl.carousel.min.js') }}" type="application/javascript"></script>
    <script src="{{ asset('str_dash/js/metisMenu.min.js')}}" type="application/javascript"></script>
    <script src="{{ asset('str_dash/js/jquery.slimscroll.min.js')}}" type="application/javascript"></script>
    <script src="{{ asset('str_dash/js/jquery.slicknav.min.js')}}" type="application/javascript"></script>
    <!-- Start datatable js -->
    <script src="{{ asset('data_table/js/jquery.dataTables.js') }}" type="application/javascript"></script>
    <script src="{{ asset('data_table/js/jquery.dataTables.min.js') }}" type="application/javascript"></script>
    <script src="{{ asset('data_table/js/dataTables.bootstrap4.min.js') }}" type="application/javascript"></script>
    <script src="{{ asset('data_table/js/dataTables.responsive.min.js') }}" type="application/javascript"></script>
    <script src="{{ asset('data_table/js/responsive.bootstrap.min.js') }}" type="application/javascript"></script>
    <!-- others plugins -->
    <script src="{{ asset('str_dash/js/plugins.js') }}" type="application/javascript"></script>
    <script src="{{ asset('str_dash/js/scripts.js')}}" type="application/javascript"></script> --}}
    @if(auth::check())
    @include('inc/footer')
    @endif
    <!--
        ______                                                               ________ __________
        |             \          /\          /  /\       |         |         |            |
        |              \        /  \        /  /  \      |         |         |            |
        |_____  _____   \      /    \      /  /__ _\     |         |         |_____       |
        |                \    /      \    /  /      \    |         |         |            |
        |                 \  /        \  /  /        \   |         |         |            |
        |_____             \/          \/  /          \  |________ |________ |_____       |

    -->
</body>
</html>
