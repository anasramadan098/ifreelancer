<!DOCTYPE html>
<html lang="en">
@extends('components.head')
@section('title' , 'All Freelancers')
@section('desc' , 'All Freelancers in One Page ! You Can Search By Name Or Filter depends on your requirements')
@section('keywords' , 'freelancers , freelance , ifreelancer , عمل_حر , freelancers page , all freelancers')
@section('adds')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/freelancers.css') }}">
@endsection
<body>
    @extends('components.header')
    <!-- Welcome -->
    <section class="search-welcome bg">
        <h1>Search Freelancers</h1>
        <p><a href="/">Home</a> / <span>Search Freelancers</span></p>
    </section>
    <!-- Scroll -->
    <div class="browse">
        <h2>Browse Top Job Categories</h2>
        <swiper-container class="mySwiper" slides-per-view="3">
            <swiper-slide>
                <div class="img">
                    <img src="../imgs/business.png" alt="business">
                </div>
                <div class="text">
                    <a href="#">Business</a>

                    <p>Items:<span>{{$categoriesCount['bus']}}</span></p>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="img">
                    <img src="../imgs/digital-marketing.png" alt="digital-marketing">
                </div>
                <div class="text">
                    <a href="#">Digital Marketing</a>
                    <p>Items:<span>{{$categoriesCount['marketing']}}</span></p>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="img">
                    <img src="../imgs/mobiles.png" alt="mobiles">
                </div>
                <div class="text">
                    <a href="#">Mobiles</a>
                    <p>Items:<span>{{$categoriesCount['code']}}</span></p>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="img">
                    <img src="../imgs/music-&-audio.png" alt="music-&-audio">
                </div>
                <div class="text">
                    <a href="#">Music & Audio</a>
                    <p>Items:<span>{{$categoriesCount['music']}}</span></p>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="img">
                    <img src="../imgs/programming-&-tech.png" alt="programming-&-tech">
                </div>
                <div class="text">
                    <a href="#">Programming & Tech</a>
                    <p>Items:<span>{{$categoriesCount['code']}}</span></p>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="img">
                    <img src="../imgs/video-&-animation.png" alt="video-&-animation">
                </div>
                <div class="text">
                    <a href="#">Video & Animation</a>
                    <p>Items:<span>{{$categoriesCount['video']}}</span></p>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="img">
                    <img src="../imgs/writing-&-translation.png" alt="writing-&-translation">
                </div>
                <div class="text">
                    <a href="#">Writing & Translation</a>
                    <p>Items:<span>{{$categoriesCount['write']}}</span></p>
                </div>
            </swiper-slide>
          </swiper-container>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <!-- Content -->
    <section class="content">
        <nav>
          <form action="" method="get" class="filters">
            <div class="filter">
              <h3>Filter Freelancers By</h3>
              <div class="inputs row">
                <h4>Start Your Search</h4>
                <div class="input">
                  <input type="search" name="keyword" value="{{request('keyword')}}" placeholder="Type Freelancer Name" />
                </div>
              </div>
            </div>
            <div class="filter">
                <h3>
                  <p>
                    Freelancer type:
                    <span>( <span>0</span> Selected )</span>
                  </p>
                  <i class="fa-solid fa-arrow-down"></i>
                </h3>
                <div class="inputs row" hidden>
                  <div class="input">
                    <input type="checkbox" id="Agency" value="Agency" name="freelancer-type[]" />
                    <label for="Agency">Agency Freelancers</label>
                  </div>
                  <div class="input">
                    <input
                      type="checkbox"
                      id="Independent"
                      value="Independent"
                      name="freelancer-type[]"
                    />
                    <label for="Independent">Independent Freelancers</label>
                  </div>
                  <div class="input">
                    <input type="checkbox" id="Rising" value="Rising" name="freelancer-type[]" />
                    <label for="Rising">New Rising Talent</label>
                  </div>
                </div>
            </div>
            <div class="filter">
                <h3>
                  <p>
                    Hourly Rate:
                    <!-- <span>( <span>0</span> Selected )</span> -->
                  </p>
                  <i class="fa-solid fa-arrow-down"></i>
                </h3>
                <div class="inputs row" hidden>
                    <div class="input">
                            <input type="radio" checked name="hourly-rate" value="$5" id="$5 And Below" />
                            <label for="$5 And Below">$5 And Below</label>
                        </div>
                        <div class="input">
                            <input type="radio" name="hourly-rate" id="$5 - $10" />
                            <label for="$5 - $10">$5 - $10</label>
                        </div>
                        <div class="input">
                            <input type="radio" name="hourly-rate" id="$10 - $20" />
                            <label for="$10 - $20">$10 - $20</label>
                        </div>
                        <div class="input">
                            <input type="radio" name="hourly-rate" id="$30 - $40" />
                            <label for="$30 - $40">$30 - $40</label>
                        </div>
                        <div class="input">
                            <input type="radio" name="hourly-rate" id="$40 - $50" />
                            <label for="$40 - $50">$40 - $50</label>
                        </div>
                        <div class="input">
                            <input type="radio" name="hourly-rate" id="$50 - $60" />
                            <label for="$50 - $60">$50 - $60</label>
                        </div>
                        <div class="input">
                            <input type="radio" name="hourly-rate" id="$60 - $70" />
                            <label for="$60 - $70">$60 - $70</label>
                        </div>
                        <div class="input">
                            <input type="radio" name="hourly-rate" id="$70 - $80" />
                            <label for="$70 - $80">$70 - $80</label>
                        </div>
                        <div class="input">
                            <input type="radio" name="hourly-rate" id="$80 - $90" />
                            <label for="$80 - $90">$80 - $90</label>
                        </div>
                        <div class="input">
                            <input type="radio" name="hourly-rate" id="$100 And Above" />
                            <label for="$100 And Above">$100 And Above</label>
                        </div>
                </div>
            </div>
            <div class="filter">
              <h3>
                <p>
                    Industrial experiences:
                  <span>( <span>0</span> Selected )</span>
                </p>
                <i class="fa-solid fa-arrow-down"></i>
              </h3>
              <div class="inputs inputs-search row" hidden>
                <div class="input">
                  <input
                    type="search"
                    name="search-industrial"
                    placeholder="Industrial experiences"
                    class="searchInput"
                  />
                  <!-- <i class="fa-brands fa-searchengin search-category"></i> -->
                </div>
                <div class="industrial-result"></div>
              </div>
            </div>
            <div class="filter">
              <h3>
                <p>
                    Specialization:
                  <span>( <span>0</span> Selected )</span>
                </p>
                <i class="fa-solid fa-arrow-down"></i>
              </h3>
              <div class="inputs inputs-search row" hidden>
                <div class="input">
                  <input
                    type="search"
                    name="search-specialization"
                    placeholder="Search Specialization"
                    class="searchInput"
                  />
                  <!-- <i class="fa-brands fa-searchengin search-category"></i> -->
                </div>
                <div class="specialization-result"></div>
              </div>
            </div>
            <div class="filter">
              <h3>
                <p>
                  Skills:
                  <span>( <span>0</span> Selected )</span>
                </p>
                <i class="fa-solid fa-arrow-down"></i>
              </h3>
              <div class="inputs inputs-search row" hidden>
                <div class="input">
                  <input
                    type="search"
                    name="search-skills"
                    placeholder="Search Skills"
                    class="searchInput"
                  />
                  <!-- <i class="fa-brands fa-searchengin search-category"></i> -->
                </div>
                <div class="skills-result">
                  @foreach (config('skills') as $skill)
                  <div class="input">
                    <input type="checkbox" name="{{$skill}}" id="{{$skill}}">
                    <label for="{{$skill}}">{{$skill}}</label>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="filter">
              <h3>
                <p>
                  English Level:
                  <span>( <span>0</span> Selected )</span>
                </p>
                <i class="fa-solid fa-arrow-down"></i>
              </h3>
              <div class="inputs row" hidden>
                <div class="input">
                  <input type="checkbox" id="basic" value="basic" name="english-level[]" />
                  <label for="basic">Basic</label>
                </div>
                <div class="input">
                  <input type="checkbox" id="conversational" name="english-level[]" value="conversational" />
                  <label for="conversational">Conversational</label>
                </div>
                <div class="input">
                  <input type="checkbox" id="fluent" value="fluent" name="english-level[]" />
                  <label for="fluent">Fluent</label>
                </div>
                <div class="input">
                  <input type="checkbox" id="native-or-bilingual" value="native-or-bilingual" name="english-level[]" />
                  <label for="native-or-bilingual">Native Or Bilingual</label>
                </div>
                <div class="input">
                  <input type="checkbox" value="professional" id="professional" name="english-level[]" />
                  <label for="professional">Professional</label>
                </div>
              </div>
            </div>
            <p>Click “Apply Filter” to apply latest changes made by you.</p>
            <input type="submit" class="btn" value="Apply Vilters" />
          </form>
        </nav>
        <div class="cards">
          @foreach ($freelancers as $freelancer)
            <div class="card" onclick="window.location.href='/freelancers/{{$freelancer->id}}'">
              <div class="head">
                  <div class="info">
                      <img src="{{asset("$freelancer->img")}}" class="freelancer-img" alt="{{$freelancer->full_name}} Image">
                      <div class="text" style="flex-basis: 100%">
                          <p class="name">
                              <i class="fa-solid fa-certificate"></i>
                              <a href="/freelancers/{{$freelancer->id}}">{{$freelancer->full_name}}</a>
                          </p>
                          <a href="/freelancers/{{$freelancer->id}}">{{ $freelancer->job_title }}</a>
                          <ul class="info-list">
                              <li>
                                  <i class="fa-solid fa-money-bill"></i>
                                  <p>$<span class="price">{{$freelancer->hourly_price}}</span>  / hr</p>
                              </li>
                              <li>
                                  <img src="../imgs/{{$freelancer->country}}.png" alt="{{$freelancer->country}}">
                                  <p>{{strtoupper($freelancer->country)}}</p>
                              </li>
                              <li>
                                  <img src="../imgs/favorite.png" alt="heart">
                                  <a href="/save-user/{{$freelancer->id}}">Save</a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="rate">
                    <div class="stars">
                      @for ($i = 1; $i <= 5; $i++)
                          @if ($i <= $freelancer->stars)
                              <i class="fas fa-star fill"></i>
                          @else
                          <i class="fa-regular fa-star"></i>
                          @endif
                      @endfor
                    </div>
                      <span><span class="freelancer-rate">{{$freelancer->stars}}</span>/5</span>
                      <p>
                        <a href="/feedbacks/{{$freelancer->id}}">
                        ({{count(json_decode($freelancer->feedbacks))}} Feedback)
                        </a>
                      </p>
                  </div>
              </div>
              <p class="desc">
                {{$freelancer->bio}}
              </p>
              <ul class="skills">
                @foreach (json_decode($freelancer->skills) as $skill)
                  <li class="skill">
                    <a href="#">{{$skill->name}}</a>
                  </li>
                @endforeach
              </ul>
            </div>
          @endforeach
        </div>
    </section>

    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->
    <script src="{{asset('js/category.js')}}"></script>
    <script>
      document.querySelectorAll('swiper-slide a').forEach(a => {
        console.log(a.textContent);
        
        a.href = '?category=' + a.textContent.trim().replaceAll(' ','-').toLowerCase();
        

      })

      const industries = [
          'Aerospace/Defense','Automotive','Banking','Biotechnology','Computer Hardware','Computer Software & Services'
      ]
      const specilization = [
          'Academic – K-12Asset',' Management','Change Management','Employee Onboarding','Organizational Development'
      ]

      industries.forEach(industry => createCheckBoxAbout(industry,document.querySelector('.industrial-result'),'industrial[]')) ;
      specilization.forEach(speciliz => createCheckBoxAbout(speciliz,document.querySelector('.specialization-result','specialization[]'))) ;

    </script>

    <script>
      if (document.querySelector('.desc').textContent.length > 250) {
        document.querySelector('.desc').textContent = document.querySelector('.desc').textContent.slice(0,250) + '....'
      }
    </script>
</body>
</html>