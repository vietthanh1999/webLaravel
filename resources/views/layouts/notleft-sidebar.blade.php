<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Blog | E-Shopper</title>
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{ asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
	<link href="{{ asset('css/main.css')}}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/rate.css')}}">

    <title>Add @yield('title')</title>
    {{-- <base href="{{asset('')}}"> --}}

    @yield('css')
    <link rel="shortcut icon" href="{{ asset('images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/ico/apple-touch-icon-57-precomposed.png')}}">
    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
</head>

<body>

    @include('layouts.header')

    @yield('content')


    @include('layouts.footer')


	<script src="{{ asset('js/price-range.js')}}"></script>
	<script src="{{ asset('js/jquery.scrollUp.min.js')}}"></script>

    <script src="{{ asset('js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{ asset('js/main.js')}}"></script>

    @yield('script')
</body>

</html>
