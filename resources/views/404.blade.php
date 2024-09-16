<!DOCTYPE html>
<html lang="en">
@extends('components.head')
@section('title' , 'Page Not Found')
@section('adds')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .error {
            text-align: center;
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: .3s;
            flex-direction: column;
            animation: mymove 5s infinite;
            h1 {
                font-size:10em;
                color:#f00;
            }
            p {
                font-size: 30px;
                line-height: 2;
                letter-spacing: .2px
            }
        }
    </style>
    <script>
        document.querySelector('header').classList.add('scrolled')
    </script>
@endsection
<body>
    <!-- Start Header -->
    @extends('components.header')
    <!-- End Header -->
    
    <div class="error">
        <h1>404</h1>
        <p>{{$error}}</p>
    </div>



    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->

</body>
</html>