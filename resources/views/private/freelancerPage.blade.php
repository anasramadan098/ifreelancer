<!DOCTYPE html>
<html lang="en">
@extends('components.head')
@section('title')

{{$user->username}} Page

@endsection
@section('adds')
    <link rel="stylesheet" href="{{ asset('css/freelaner-personal.css') }}">
    <style>
        .add {
            background: #fff;
            padding: 40px 20px 20px;
            border-radius: 10px;
            display: none;
            flex-direction: column;
            gap: 20px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            .close {
                position: absolute;
                top:3%;
                right:5%;
                cursor:pointer;
            }
        }  
        .projects {
            padding: 0 !important;
            .imgs {
                padding: 30px;
            }
        }
        .add-btn-div {
            display: flex;
            justify-content:space-between;
            width:100%;
            padding: 30px;
        }
        .theme {
            h2 {
                padding:0 !important;
            }
        }
        .d-flex {
            justify-content: space-between !important;
        }
        .input {
            display: flex;
            align-items: center;
            gap: 5px;
            input {
                padding: 5px !important;
                width:1.15em !important;
            }
        }
    </style>
@endsection
<body>
    <div class="overlay" style="display: none;"></div>
    <!-- Start Header -->
        @extends('components.header')
    <!-- End Header -->
    <div class="freelancer-bg bg"></div>
    <div class="info">
        <div class="img">
            <img src="{{asset("$user->img")}}" alt="{{$user->full_name}} Image">
            <p class="name">
                <i class="fa-solid fa-certificate"></i>
                <a href="#">{{$user->full_name}}</a>
            </p>
            <p><span class="freelancer-rate">{{$user->stars}}</span>\5 <span class="feedback"><a href="/feedbacks/{{$user->id}}">(<span>{{count(array($user->feedbacks))}} </span>Feedback)</span></a></p>
            {{-- <p><span class="freelancer-rate">0</span>\5 <span class="feedback">(<span>0  </span>Feedback)</span></p> --}}
            <p style="color: #777;">Member since <span class="freelancer-date">{{ Carbon\Carbon::parse($user->created_at)->format('M d Y') }}</span></p>
        </div>
        <div class="text">
            <h2>{{$user->job_title}}</h2>
            <ul class="info-list">
                <li>
                    <i class="fa-solid fa-money-bill"></i>
                    <p>$<span class="price">{{ $user->hourly_price }}</span>  / hr</p>
                </li>
                <li>
                    <img src="../imgs/usa.png" alt="">
                    <p>{{$user->country}}</p>
                </li>
            </ul>

            
            <a href="#"></a>
            <p>
                {{$user->bio}}
            </p>
            @if (strlen($user->bio) > 400)
                <a href="#">Read More</a>
            @endif
        </div>
        <div class="rates">
            <div class="boxes">
                <div class="box">
                    <span class="number" style="color: var(--seconde-color)">{{$user->on_projects}}</span>
                    <p>Ongoing projects</p>
                </div>
                <div class="box">
                    <span class="number" style="color: #3498db;">{{ $user->completed_projectes }}</span>
                    <p>Completed projects</p>
                </div>
                <div class="box">
                    <span class="number" style="color: var(--primary-color)">{{ $user->cancelled_projects }}</span>
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
                    <span class="number" style="color: #9b59b6;">${{$user->total_earning}}</span>
                    <p>Total earnings</p>
                </div>
                <a href="#send-money" class="box" style="cursor: pointer" >
                    <span class="number avalibeMoney">${{$user->currency}}</span>
                    <p>Avalible earnings</p>
                </a>
            </div>
            <a href="/me/edit" class="btn">Edit Your Profile 😁</a>
            <a href="/add-job" class="btn delete">Add Project 🤩</a>
        </div>
    </div>
    <div class="flex">
        <div class="full-info">
            <!-- Start my Projects -->
            <div class="experience theme">
                <div class="add-btn-div">
                    <h2>My Projects</h2>
                    <a class="btn" href="/add-job">Add Project</a>
                </div>
                <div class="boxes">
                    @if (count(json_decode($jobs)) > 0)
                        @foreach (json_decode($jobs) as $job)
                            <div class="box">
                                <div class="d-flex">
                                    <h4>{{$job->name}}</h4>
                                    <a class="btn delete" target="blank" href="/projects/{{$job->id}}">Project Page</a>
                                </div>
                            </div>
                        @endforeach
                    @else 
                            <p style="margin:0 20px;font-size:1em;color:#777;">Not Add Projects Yet :(</p>
                    @endif
                </div>
            </div>
            <!-- End My Projects -->
            <!-- Start Projects -->
            <div class="projects">
                <form method="POST" action="/add-project" class="add">
                    @method('put')
                    @csrf
                    <i class="fa-solid fa-x close"></i>
                    <input type="text" required placeholder="Write Your Project Name" name="projectName">
                    <input type="url" name="url" placeholder="URL Project">
                    {{-- <textarea name="description">Project Description</textarea> --}}
                    <input type="submit" value="Add Project" class="btn">
                </form>
                <div class="add-btn-div">
                    <h2>Crafted Projects</h2>
                    <button class="btn">Add Project</button>
                </div>
                <div class="imgs">
                    @if (count(json_decode($user->projects)) > 0)
                        @foreach (json_decode($user->projects) as $project)
                        <div class="img">
                            <img src={{"../imgs/" . $project->img}} alt="Project Img">
                            <h4>{{$project->title}}</h4>
                            <a href="{{ $project->url }}">{{ $project->url }}</a>
                            <form action="/remove-project/{{$project->title}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input value="Delete" type="submit" class="btn delete">
                            </form>
                        </div>
                        @endforeach
                    @else 
                            <p style="font-size:1em;color:#777;">Not Have Projects Yet :(</p>
                    @endif
                </div>
            </div>
            <!-- Start Experience -->
            <div class="experience theme">

                {{-- Form --}}
                <form method="POST" action="/add-experience" class="add">
                    @method('put')
                    @csrf
                    <i class="fa-solid fa-x close"></i>
                    <input type="text" required placeholder="Title" name="title">
                    <input type="text" required placeholder="Company" name="company">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date">
                    <textarea name="bio">Experience Description</textarea>
                    <input type="submit" value="Add" class="btn">
                </form>

                <div class="add-btn-div">
                    <h2>Experiences</h2>
                    <button class="btn">Add Experience</button>
                </div>
                <div class="boxes">
                    @if (count(json_decode($user->experiences)) > 0)
                        @foreach (json_decode($user->experiences) as $experience)
                            <div class="box">
                                <div class="d-flex">
                                    <h4>{{$experience->title}}</h4>
                                    <form action="/remove-experience/{{$experience->title}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input value="Delete" type="submit" class="btn delete">
                                    </form>
                                </div>
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

                {{-- Form --}}
                <form method="POST" action="/add-education" class="add">
                    @method('put')
                    @csrf
                    <i class="fa-solid fa-x close"></i>
                    <input type="text" required placeholder="Title" name="title">
                    <input type="text" required placeholder="Company" name="company">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date">
                    <textarea name="bio">Education Description</textarea>
                    <input type="submit" value="Add" class="btn">
                </form>
                <div class="add-btn-div">
                    <h2>Education</h2>
                    <button class="btn">Add Education</button>
                </div>
                <div class="boxes">
                    @if (count(json_decode($user->educations)) > 0)
                        @foreach (json_decode($user->educations) as $education)
                            <div class="box">
                                <div class="d-flex">
                                    <h4>{{$education->title}}</h4>
                                    <form action="/remove-education/{{$education->title}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input value="Delete" type="submit" class="btn delete">
                                    </form>
                                </div>
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
                    @foreach (json_decode($user->skills) as $skill)
                        <div class="skill">
                            <h5>{{$skill->name}}</h5>
                            <span>{{$skill->percentage}}</span>
                            <div class="progress" style="--percentage:{{$skill->percentage}}"></div>
                        </div>
                    @endforeach
                </div>
            <div class="languages">
                <h3>Languages</h3>
                <ul>
                    <li>English</li>
                    @if (false)
                    @foreach ($user->langs as $lang)
                        <li>{{ $lang }}</li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class="english-level">
                <h3>English level</h3>
                <ul>
                    <li>{{ strtoupper($user->english_level[0]) }}{{ substr($user->english_level,1,strlen($user->english_level)) }}</li>
                </ul>
            </div>
            <div class="english-level">
                <h3>Freelancer type</h3>
                <ul>
                    @if ($user->freelancer_type)
                        <li>{{ strtoupper($user->freelancer_type[0]) }}{{ substr($user->freelancer_type,1,strlen($user->freelancer_type)) }} Freelancer</li>
                    @else
                        <li>Job Owner</li>
                    @endif
                </ul>
            </div>
            <div class="share">
                <h3>Share Your Account</h3>
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
            <div class="report" id="send-money">
                <h3>Put Your <span style="color:#3498db;">PayPal</span> Account</h3>
                <form action="/recive-money" class="sendMoney sureForm" method="POST">
                    @csrf
                    <div class="d-flex">
                        <div class="input">
                            <input type="radio" name="money_type" id="send" value="send">
                            <label for="send">Send</label>
                        </div>
                        <div class="input">
                            <input type="radio" checked name="money_type" id="recive" value="recive">
                            <label for="recive">Recive</label>
                        </div>
                    </div>
                    <input type="email" name="email_for_user" placeholder="Write Your PayPal Email">
                    <input type="number" name="accurancy_of_money" placeholder="Write Your Money">
                    <input type="submit" class="btn delete sureBtn" value="Send Now">
                </form>
            </div>
        </nav>
    </div>
    <!-- Start Footer  -->
        @extends('components.footer')
    <!-- End Footer  -->
    <script src="{{ asset('js/freelaner-personal.js') }}"></script>
    <script>
        document.querySelectorAll('.add-btn-div button').forEach(btn => {

        btn.addEventListener('click',() => {
            document.querySelector('.overlay').style.display = 'block';
            btn.parentElement.parentElement.firstElementChild.style.display = 'flex';    
        })

        })

        document.querySelectorAll('form .close').forEach(btn => {

            btn.addEventListener('click',() => {
                document.querySelector('.overlay').style.display = 'none';
                btn.parentElement.style.display = 'none';    
            })

        })

        const moneyTypeBtns = document.querySelectorAll('form .input input[type="radio"]');
        moneyTypeBtns.forEach(btn => {
            btn.addEventListener('click' , () => {
                document.querySelector('form.sendMoney').action = `/${btn.value.toLowerCase()}-money`;
            })
        })

        const  avalibeMoney = document.querySelector('.avalibeMoney');
        if (avalibeMoney.textContent ==  '$0' ) {
            avalibeMoney.style.color = 'red';
        } else {
            avalibeMoney.style.color = 'green';
        }
    </script>
    <script src="{{ asset('js/sure.js') }}"></script>
</body>
</html>
