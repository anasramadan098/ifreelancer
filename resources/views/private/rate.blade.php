<!DOCTYPE html>
<html lang="en">
<head>
    @extends('components.head')
    @section('title' , 'Rate User')
    @section('adds')
        <link rel="stylesheet" href="{{asset("css/rate.css")}}">
    @endsection
</head>
<body>
    <!-- Start Header -->
    @extends('components.header')
    <!-- End Header -->
    
    <section class="rate">
        <div class="title">
            <h2>Rate The Freelancer 😎</h2>
            <h5>This Is Very Important For Freelancer. Please Rate Correctly</h5>
        </div>
        <form action="/recive-project" class="sureForm" method="POST">
            @csrf
            <input type="hidden" name="stars" value="0">
            <input type="hidden" name="ji" value="{{$projectId}}">
            <input type="hidden" name="pi" value="{{$proposalId}}">
            <div class="input">
                <h3>How Many Stars You Will Rate The Freelancer</h3>
                <div class="stars">
                    <span class="star">1</span>
                    <span class="star">2</span>
                    <span class="star">3</span>
                    <span class="star">4</span>
                    <span class="star">5</span>
                </div>
            </div>
            <div class="input">
                <h3>
                    Do You Have A Feedback ?
                </h3>
                <textarea name="feedback" placeholder="Write Your Feedback Here"></textarea>
            </div>
            <div class="btns">
                <a href="/inbox" class="btn delete">Back Step</a>
                <button class="btn sureBtn">Rate And Recive Project</button>
            </div>
        </form>
    </section>

    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->

    <script src="{{ asset('js/rate.js') }}"></script>
    <script src="{{ asset('js/sure.js') }}"></script>
</body>
</html>