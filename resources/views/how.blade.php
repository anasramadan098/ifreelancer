<!DOCTYPE html>
<html lang="en">
@extends('components.head')
@section('title' , 'How To Use ifreelancer')

@section('desc' , 'Now You Can Learn How to Use "ifreelancer" Correctly Without any errors')
@section('keywords' , 'how, ifreelancer , freelance , freelancer , عمل_حر , how to use ifreelancer')

@section('adds')
    <link rel="stylesheet" href="{{asset('css/faq.css')}}">
    <link rel="stylesheet" href="{{asset('css/about.css')}}">
    <style>
        .bg {
            background: url(../imgs/howBg.jpg);
        }
    </style>
@endsection
<body>
    <!-- Start Header -->
    @extends('components.header')
    <!-- End Header -->
    <div class="bg">
        <h1>How it works</h1>
        <p><a href="/">Home</a> / <span>How it works</span></p>
    </div>
    <section class="content">
        <div class="part">
            <div class="title">
                <h2>How To Start Hiring</h2>
                <h5>Start Today For a Great Future</h5>
                <p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua eniina ilukita ylokem lokateise ination voluptate velite esse cillum dolore eu fugnulla pariatur lokaim urianewce animid
                </p>
                <div class="faq">
                    <div class="holder">
                        <h3 class="question">Adipisicing elit, sed do eiusmod tempor incididunt?</h3>
                        <div class="answer open">
                            <h4>Digital Marketing</h4>
                            <p>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore eta dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.                            </p>
                        </div>
                    </div>
                    <div class="holder">
                        <h3 class="question">Adipisicing elit, sed do eiusmod tempor incididunt?</h3>
                        <div class="answer">
                            <h4>Digital Marketing</h4>
                            <p>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore eta dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.                            </p>
                        </div>
                    </div>
                    <div class="holder">
                        <h3 class="question">Adipisicing elit, sed do eiusmod tempor incididunt?</h3>
                        <div class="answer">
                            <h4>Digital Marketing</h4>
                            <p>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore eta dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <img src="../imgs/how-page-1.jpg" alt="how-1">
        </div>
        <div class="part">
            <div class="title">
                <h2>How To Start Hiring</h2>
                <h5>Start Today For a Great Future</h5>
                <p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua eniina ilukita ylokem lokateise ination voluptate velite esse cillum dolore eu fugnulla pariatur lokaim urianewce animid
                </p>
            </div>
            <img src="../imgs/how-page-1.jpg" alt="how-2">
        </div>
        <div class="part">
            <div class="title">
                <h2>How To Start Hiring</h2>
                <h5>Start Today For a Great Future</h5>
                <p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua eniina ilukita ylokem lokateise ination voluptate velite esse cillum dolore eu fugnulla pariatur lokaim urianewce animid
                </p>
            </div>
            <img src="../imgs/how-page-1.jpg" alt="how-3">
        </div>
    </section>

    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->

    <script src="{{asset('js/faq.js')}}"></script>
</body>
</html>