<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Font -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

    <!-- Stylesheets -->

    <link href="{{ asset('assets/frontend/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/swiper.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/ionicons.css') }}" rel="stylesheet">

    <!-- Librairie Toast -->
    <link href="{{ asset('assets/toast/toastr.min.css') }}" rel="stylesheet" />

    @yield('css')
</head>
<body>

@include('layouts.frontend.partials.header')

@yield('content')


@include('layouts.frontend.partials.footer')

        <!-- SCIPTS -->

<script src="{{ asset('assets/frontend/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/tether.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/frontend/js/swiper.js') }}"></script>
<script src="{{ asset('assets/frontend/js/scripts.js') }}"></script>

@yield('js')
        <!-- Librairie Toast -->
<script src="{{ asset('assets/toast/toastr.min.js') }} "></script>
{!! Toastr::message() !!}
        <!-- Librairie Toast -->
@yield('js')
<script type="text/javascript">
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{ $error }}}', 'Error', {
                closeButton:true,
                progessBar:true
            });
    @endforeach
    @endif
</script>
</body>
</html>
