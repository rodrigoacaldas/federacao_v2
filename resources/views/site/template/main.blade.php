<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'Federação') }}.</title>
    <link rel="shortcut icon" href="{{url('assets/images/favicon.png')}}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="{{url('site/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{url('site/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('site/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{url('site/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{url('site/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('site/css/owl.theme.default.min.css')}}">


    <link rel="stylesheet" href="{{url('site/css/aos.css')}}">

    <link rel="stylesheet" href="{{url('site/css/style.css')}}">

</head>
<body>

<div class="site-wrap">

    @include('site.template.header')

    @yield('header')

    @yield('content')

    @include('site.template.footer')

</div>

<script src="{{url('site/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{url('site/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{url('site/js/jquery-ui.js')}}"></script>
<script src="{{url('site/js/popper.min.js')}}"></script>
<script src="{{url('site/js/bootstrap.min.js')}}"></script>
<script src="{{url('site/js/owl.carousel.min.js')}}"></script>
<script src="{{url('site/js/jquery.stellar.min.js')}}"></script>
<script src="{{url('site/js/jquery.countdown.min.js')}}"></script>
<script src="{{url('site/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{url('site/js/aos.js')}}"></script>

<script src="{{url('site/js/main.js')}}"></script>

</body>
</html>
