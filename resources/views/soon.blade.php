<!DOCTYPE html>
<html lang="en">
<head>
    @extends('components.head')
    @section('adds')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <style>
            .bg {
                background: url(../imgs/howBg.jpg);
                background-size: cover;
            }
        </style>
    @endsection
</head>
<body>
    
    <!-- Start Header -->
    @extends('components.header')
    {{-- End Header --}}
    <div class="bg">
        <h1 class="text-center">Soon</h1>
    </div>
    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->
</body>
</html>