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
        window.user = @json((auth()->user() ? auth()->user() :  Session::get('user') ))
    </script>
    @if( Session::get('user'))
        <script>
            window.localStorage.setItem('user', @json(Session::get('username')));
        </script>
    @endif
    @endauth
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ewallet.css') }}" rel="stylesheet">
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
    <div class="main-content-inner {{auth::check() ? '' : 'login-area login-s2' }}" id="{{auth::check() ? '' : 'main-content'}}">
        <router-view></router-view>
         <!-- set progressbar -->
         <vue-progress-bar></vue-progress-bar>
     </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/ewallet.js') }}" type="application/javascript"></script>
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
