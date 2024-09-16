<!DOCTYPE html>
<html lang="en">
@extends('components.head')
@section('title')
    {{$freelancer->username}} Page
@endsection

@section('desc')
    You Can See All Info About Freelancer "{{$freelancer->username}}"
@endsection
@section('keywords'){{$freelancer->username}},
    freelancer,
    freelance,
    freelancer in {{$freelancer->country}},
    ifreelancer    
@endsection

@section('adds')
    <link rel="stylesheet" href="{{ asset('css/freelaner-personal.css') }}">
@endsection


<body>
    <!-- Start Header -->
        @extends('components.header')
    <!-- End Header -->
    <div class="freelancer-bg bg"></div>

@if ($not_found)
    <p>{{$not_found}}</p>
@else
    <div class="info">
        <div class="img">
                <img src="{{asset("$freelancer->img")}}" alt="{{$freelancer->full_name}} Image">
            <p class="name">
                <i class="fa-solid fa-certificate"></i>
                <a href="#">{{$freelancer->full_name}}</a>
            </p>
            <p><span class="freelancer-rate">{{$freelancer->stars}}</span>\5 <span class="feedback">( <a href="/feedbacks/{{$freelancer->id}}"><span>{{count(json_decode($freelancer->feedbacks))}}</span> Feedback</a> )</span></p>
            {{-- <p><span class="freelancer-rate">0</span>\5 <span class="feedback">(<span>0  </span>Feedback)</span></p> --}}
            <p style="color: #777;">Member since <span class="freelancer-date">{{ Carbon\Carbon::parse($freelancer->created_at)->format('M d Y') }}</span></p>
        </div>
        <div class="text">
            <h2>{{$freelancer->job_title}}</h2>
            <ul class="info-list">
                <li>
                    <i class="fa-solid fa-money-bill"></i>
                    <p>$<span class="price">{{ $freelancer->hourly_price }}</span>  / hr</p>
                </li>
                <li>
                    <img src="../imgs/{{$freelancer->country}}.png" alt="{{$freelancer->country}}">
                    <p>{{$freelancer->country}}</p>
                </li>
                <li>
                    <img src="../imgs/favorite.png" alt="heart">
                    <p>Save</p>
                </li>
            </ul>
            <p>
                {{$freelancer->bio}}
            </p>
                @if (strlen($freelancer->bio) > 400)
                    <a href="#">Read More</a>
                @endif
        </div>
        <div class="rates">
            <div class="boxes">
                <div class="box">
                    <span class="number" style="color: var(--seconde-color)">{{$freelancer->on_projects}}</span>
                    <p>Ongoing projects</p>
                </div>
                <div class="box">
                    <span class="number" style="color: #3498db;">{{ $freelancer->completed_projectes }}</span>
                    <p>Completed projects</p>
                </div>
                <div class="box">
                    <span class="number" style="color: var(--primary-color)">{{ $freelancer->cancelled_projects }}</span>
                    <p>Cancelled projects</p>
                </div>
                <div class="box">
                    <span class="number" style="color: var(--seconde-color)">0</span>
                    <p>Ongoing services</p>
                </div>
                <div class="box">
                    <span class="number" style="color: #3498db;">0</span>
                    <p>Completed services</p>
                </div>
                <div class="box">
                    <span class="number" style="color: var(--primary-color)">0</span>
                    <p>Cancelled services</p>
                </div>
                <div class="box">
                    <span class="number" style="color: #9b59b6;">${{$freelancer->total_earning}}</span>
                    <p>Total earnings</p>
                </div>
            </div>
            @if (Auth::check())
                @if (Auth::user()->id == $freelancer->id) 
                    <p class="btn delete">This Is Your Profile</p>
                @else
                    <a href="/add-job?user={{$freelancer->id}}" class="btn">Send Offer</a>
                @endif
            @endif
        </div>
    </div>
    <div class="flex">
        <div class="full-info">
            <!-- Start Projects -->

            <div class="projects">
                <h2>Crafted Projects</h2>
                <div class="imgs">
                    @if (count(json_decode($freelancer->projects)) > 0)
                        @foreach (json_decode($freelancer->projects) as $project)
                        <div class="img">
                            <img src={{"../imgs/" . $project->img}} alt="Project Img">
                            <h4>{{$project->title}}</h4>
                            <a href="{{ $project->url }}">{{ $project->url }}</a>
                        </div>
                        @endforeach
                    @else 
                            <p style="font-size:1em;color:#777;">Not Have Projects Yet :(</p>
                    @endif
                </div>
            </div>

            <!-- End Projects -->
            <!-- Start Experience -->

            <div class="experience theme">
                <h2>Experience</h2>
                <div class="boxes">
                    @if (count(json_decode($freelancer->experiences)) > 0)
                        @foreach (json_decode($freelancer->experiences) as $experience)
                            <div class="box">
                                <h4>{{$experience->title}}</h4>
                                <ul>
                                    <li>
                                        <i class="fa-solid fa-building"></i>
                                        <span>{{$experience->company}}</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <span> {{ Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - {{ Carbon\Carbon::parse($experience->end_date)->format('M Y') }}  </span>
                                    </li>
                                </ul>
                                <p>“ {{$experience->bio}} ”</p>
                            </div>
                        @endforeach
                    @else 
                            <p style="margin:0 20px;font-size:1em;color:#777;">Not Add Experience Yet :(</p>
                    @endif
                </div>
            </div>

            <!-- End Experience -->
            <!-- Start Education -->

            <div class="education theme">
                <h2>Education</h2>
                <div class="boxes">
                    @if (count(json_decode($freelancer->educations)) > 0)
                        @foreach (json_decode($freelancer->educations) as $education)
                            <div class="box">
                                <h4>{{$education->title}}</h4>
                                <ul>
                                    <li>
                                        <i class="fa-solid fa-building"></i>
                                        <span>{{$education->company}}</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <span> {{ Carbon\Carbon::parse($education->start_date)->format('M Y') }} - {{ Carbon\Carbon::parse($education->end_date)->format('M Y') }}  </span>
                                    </li>
                                </ul>
                                <p>“ {{$education->bio}} ”</p>
                            </div>
                        @endforeach
                    @else 
                            <p style="margin:0 20px;font-size:1em;color:#777;">Not Add Experience Yet :(</p>
                    @endif
                </div>
            </div>

            <!-- End Education -->
        </div>
        <nav>
            <div class="skills">
                <h3>My Skills</h3>
                    @foreach (json_decode($freelancer->skills) as $skill)
                        <div class="skill">
                            <h5>{{$skill->name}}</h5>
                            <span>{{$skill->percentage}}</span>
                            <div class="progress" style="--percentage:{{$skill->percentage}}"></div>
                        </div>
                    @endforeach
            </div>

            <div class="english-level">
                <h3>English level</h3>
                <ul>
                    <li>{{ strtoupper($freelancer->english_level[0]) }}{{ substr($freelancer->english_level,1,strlen($freelancer->english_level)) }}</li>
                </ul>
            </div>
            <div class="english-level">
                <h3>Freelancer type</h3>
                <ul>
                    <li>{{ strtoupper($freelancer->freelancer_type[0]) }}{{ substr($freelancer->freelancer_type,1,strlen($freelancer->freelancer_type)) }} Freelancer</li>
                </ul>
            </div>
            <div class="share">
                <h3>Share this freelancer</h3>
                <div class="social">
                    <a href="#">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <a href="#">
                        <i class="fa-solid fa-link"></i>
                    </a>
                </div>
            </div>
            <div class="report">
                @if (Auth::check())
                    @if (Auth::user()->id == $freelancer->id)
                        <h3>You Can't Report this freelancer</h3>
                    @else
                        <h3>Report this freelancer</h3>
                        <form action="/report/{{$freelancer->id}}" method="POST">
                            <select name="reason">
                                <option value="" selected disabled>Select Reason</option>
                                <option value="fake">This Is Fake</option>
                                <option value="other">Other</option>
                            </select>
                            <textarea name="describtion">Report Description</textarea>
                            <input type="submit" class="btn" value="Report Now">
                        </form>
                    @endif
                @endif
            </div>
        </nav>
    </div>
@endif

    <!-- Start Footer  -->
        @extends('components.footer')
    <!-- End Footer  -->
    <script src="{{ asset('js/freelaner-personal.js') }}"></script>
</body>


</html>
