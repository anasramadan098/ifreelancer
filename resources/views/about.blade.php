<!DOCTYPE html>
<html lang="en">
@extends('components.head')
@section('title' , 'About Page')
@section('desc' , "What's About Ifreelancer? You Will Know All Info About Ifreelancer From This Page")
@section('keywords' , 'Keywords')
@section('adds')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <style>
        .bg {
            background:url(../imgs/about.jpg);
        }
    </style>
@endsection
<body>
    <!-- Start Header -->
    @extends('components.header')
    <!-- End Header -->
    <div class="bg">
        <h1>About</h1>
        <p><a href="/">Home</a> / <span>About</span></p>
    </div>
    <div class="content">
        <div class="part">
            <div class="title">
                <h2>Greetings & Welcome</h2>
                <h5>Start Today For a Great Future</h5>
                <p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua eniina ilukita ylokem lokateise ination voluptate velite esse cillum dolore eu fugnulla pariatur lokaim urianewce anim id est laborumed.</p>
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa officia deserunt mollit anim id est laborumed perspiciatis unde omnis isteatus error aluptatem accusantium doloremque laudantium.
                </p>
            </div>
            <a href="#">
                <img src="../imgs/videoImg.png" alt="Video Img">
            </a>
        </div>
    </div>
    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->
</body>
</html>