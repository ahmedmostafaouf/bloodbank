<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap file css-->
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
    <!--Plugins file css-->
    <link rel="stylesheet" href="{{asset('assets/front/css/slick.css')}}">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="{{asset('assets/front/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/jquery-nao-calendar.css')}}">
    <!--google-font-->
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&display=swap" rel="stylesheet">
    <!--main file css-->
    <link rel="stylesheet" href="{{asset('assets/front/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    <title>بنك الدم</title>
</head>

<body>
<!--Loading Page-->
<div class="loading-page">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>



@include('front.includes.header')




@yield('content')





@include('front.includes.footer')

<!--scrollUp-->
<div class="scrollUp">
    <i class="fas fa-chevron-up"></i>
</div>
<!--jquery/bootstrap/main file js-->
<script src="{{asset('assets/front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/front/js/slick.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery-nao-calendar.js')}}"></script>
<script src="{{asset('assets/front/js/popper.min.js')}}"></script>
<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/front/js/main.js')}}"></script>
</body>

</html>
