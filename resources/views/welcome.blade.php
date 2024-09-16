<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('title' , 'Home Page')
    @section('desc' , 'IFREELANCER. Work Easily From Home With The Lowest Tax In World !')
    @section('keywords' , 'freelancer , ifreelancer , عمل_حر , money , work , projects')
    @section('adds')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @endsection
    <body>
        <!-- Start Header -->
        @extends('components.header')
        <!-- End Header -->
        <!-- Start Welcome Section -->
        <section class="bg welcome">
            <h2>Hire expert freelancers</h2>
            <h3><b>for any job, Online</b></h3>
            <p>Consectetur adipisicing elition sed dotem eiusmod tempor incuntes ut labore etdolore maigna aliqua enim adion minim veniam quistan neostrud exercitation.        </p>
            <form action="/jobs">
                <input type="search" style="margin:0;" class="serchValue" placeholder="I'm Looking For" name="searchValue">
                <select name="searchPage" required>
                    <option value="" selected>Select From Menu</option>
                    <option value="jobs">Jobs</option>
                    <option value="freelancers">Freelancer</option>
                    <option value="services">Services</option>
                    <!--<option value="empolyers">Empolyers</option> -->
                </select>
                <a href="#">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </form>
            <div class="play-video">
                <a href="https://youtube.com" class="icon">
                    <i class="fa-solid fa-play"></i>
                </a>
                <div class="text">
                    <h5>See For Yourself!</h5>
                    <p>How it works & experience the ultimate joy.</p>
                </div>
            </div>
        </section>
        <!-- End Welcome Section -->      
        <!-- Start Top Services Section -->
        <section class="top-services">
            <div class="title">
                <h2>Top Most Services</h2>
                <h5>Picked Top Serviced For You</h5>
                <p>This Part Will Avilable Soon ! You Can Now Start In Projects Have Fun 😁</p>
            </div>
        </section>
        <!-- End Top Services Section -->
        <!-- Start How Work Section -->
        <section class="how-work">
            <div class="title">
                <h2>How It Works</h2>
                <h5>We Made It Easy</h5>
                <p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.            </p>
            </div>
            <div class="boxes">
                <div class="box">
                    <div class="circle d-flex">
                        <div class="min-circle d-flex">
                            <img src="imgs/how-1.png" alt="How">
                        </div>
                    </div>
                    <div class="text">
                        <span>Search Best Online</span>
                        <h6>Professional</h6>
                    </div>
                </div>
                <div class="box">
                    <div class="circle d-flex">
                        <div class="min-circle d-flex">
                            <img src="imgs/how-2.png" alt="How">
                        </div>
                    </div>
                    <div class="text">
                        <span>Hire any</span>
                        <h6>Freelancer</h6>
                    </div>
                </div>
                <div class="box">
                    <div class="circle d-flex">
                        <div class="min-circle d-flex">
                            <img src="imgs/how-1.png" alt="How">
                        </div>
                    </div>
                    <div class="text">
                        <span>Leave Your</span>
                        <h6>Feedback</h6>
                    </div>
                </div>
            </div>

        </section>
        <!-- End How Work Section -->
        <!-- Start Categories -->
        <section class="categories" id="categories" style="padding: 0 !important ;">
            <div class="title">
                <h5>Explore Popular Services</h5>
            </div>
            <div class="swiper mySwiper catSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="/jobs?search-category=music-&-audio">
                            <div class="content">
                                <img src="imgs/categories-1.jpg" alt="categories">
                                <h3>Music & Audio</h3>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="/jobs?search-category=music-&-audio">
                            <div class="content">
                                <img src="imgs/categories-1.jpg" alt="categories">
                                <h3>Music & Audio</h3>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="/jobs?search-category=music-&-audio">
                            <div class="content">
                                <img src="imgs/categories-1.jpg" alt="categories">
                                <h3>Music & Audio</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <!-- End Categories -->
        <!-- Start Find Section -->
        <section class="find">
            <div>
                <h3>Find the talent needed to get your business growing.</h3>
                <p>Advertise your jobs to millions of monthly users and search 15.8 million CVs</p>
                <a href="#" class="btn">Start posting job</a>
            </div>
        </section>
        <!-- End Find Section -->
        <!-- Start FreeLancers -->
        <section class="freelancers">
            <div class="title">
                <h2>Top Freelancers</h2>
                <h5>Start With Great Peoples</h5>
                <p>
                    Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.
                </p>
            </div>
            <div class="cards">

                @forEach ($topFreelancers as $freelancer)
                    <div class="card">
                        <div class="img">
                            <div class="dot"></div>
                            @if ($freelancer->img != 'freelancer.jpg')
                            <img src='{{asset("profileImgs/" . $freelancer->username ."/". $freelancer->username .".jpg")}}' alt="freelancer">
                            @else
                                <img src='{{asset("profileImgs/defult.jpg")}}' alt="freelancer">
                            @endif                        </div>
                        <div class="text">
                            <div class="name">
                                <i class="fa-solid fa-certificate"></i>
                                <a href="/freelancers/{{$freelancer->id}}">
                                    <h5>
                                        {{$freelancer->full_name}}
                                    </h5>
                                </a>
                            </div>
                            <p class="slogan">{{$freelancer->bio}}</p>
                            <ul class="info">
                                <li>
                                    <i class="fa-solid fa-money-bill"></i>
                                    <p>${{number_format((float)$freelancer->hourly_price, 2, '.', '')}} / hr</p>
                                </li>
                                <li>
                                    <img src="imgs/usa.png" alt="">
                                    <p>
                                        {{-- Make The Country Code Transform To Country Name Automaticly --}}
                                        @php
                                            $result = getCountryName($freelancer->country);
                                        @endphp
                                        {{ $result }}
                                        
                                    </p>
                                </li>

                                <a href="/save-user/{{$freelancer->id}}">
                                    <i class="fa-solid fa-heart"></i>
                                    <p>Save</p>
                                </a>
                                
                                
                                <li>
                                    <i class="fa-solid fa-star"></i>
                                    <p>{{$freelancer->stars}}/5 <span>({{count(json_decode($freelancer->feedbacks))}} Feedback)</span></p>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                @endforEach
            </div>
        </section>
        <!-- End FreeLancers -->
        <!-- Start Search -->
        <section class="search">
            <div class="title">
                <h2>Search By</h2>
                <h5></h5>
            </div>
            <div class="cols">
                <div class="col">
                    <h6>By Skills</h6>
                    <a href="#">PHP</a>
                    <a href="#">PHP</a>
                    <a href="#">PHP</a>
                    <a href="#">PHP</a>
                    <a href="#">PHP</a>
                    <a href="#">PHP</a>
                    <a href="#">PHP</a>
                    <a href="#">PHP</a>
                    <a href="#">PHP</a>
                    <a href="#">PHP</a>
                    <a href="#" class="view">View All</a>
                </div>
                <div class="col">
                    <h6>
                        Skill By US
                    </h6>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#" class="view">View All</a>
                </div>
                <div class="col">
                    <h6>
                        By Categories
                    </h6>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#" class="view">View All</a>
                </div>
                <div class="col">
                    <h6>
                        By Locations
                    </h6>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#">PHP in United States</a>
                    <a href="#" class="view">View All</a>
                </div>
            </div>
        </section>
        <!-- End Search -->
        <!-- Start Footer  -->
        @extends('components.footer')
        <!-- End Footer  -->
        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            // Swiper
            var swiper = new Swiper(".catSwiper", {
                effect: "coverflow",
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: "auto",
                coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable:true,
                },
            });

            // Filter The Title Of Freelancers
            const freelancersTitles = document.querySelectorAll('.freelancers .card  p.slogan');
            freelancersTitles.forEach(e => {
                e.textContent = e.textContent.slice(0,21) + '...'
            })

            // Get The Half Of Swiper Elemetns
            // Get The Half 
            document.querySelectorAll('.swiper-pagination span')[Math.floor(document.querySelectorAll('.swiper-pagination span').length / 2)].click()


        </script>
        <script src="{{asset('js/main.js')}}"></script>
    </body>
</html>

