

<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('title')
    {{$project->name}} Project
    @endsection

    @section('desc')
        Proposals For Project {  {{$project->name}} } , You Can See All Info About The Proposals Of Freelancer
    @endsection
    @section('keywords' , 'freelance , freelancer , proposals , ifreelancer , projects')


    @section('adds')        
        <link rel="stylesheet" href="{{asset('css/project-detail.css')}}">
        <link rel="stylesheet" href="{{asset('css/faq.css')}}">
    @endsection
<body>
    <!-- Start Header -->
    @extends('components.header')
    <!-- End Header -->

    <div class="bg">
        <h1>Job Title</h1>
        <p><a href="/">Home</a> / <span>Job Title</span></p>
    </div>
    <section class="content">
        <!-- {/* Start Job TiTLE */} -->
        <div class="job-title">
            <div class="text">
                <h2>{{$project->name}}</h2>
                <ul>
                    <li>
                        <i class="fa-regular fa-building"></i>
                        <span>{{$project->job_type}}</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <span>{{$project->project_length}}</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-language"></i>
                        <span>{{$project->english_level}}</span>
                    </li>
                    <li>
                        <img src="../imgs/usa.png" alt="Country" />
                        <span>{{$project->user_country}}</span>
                    </li>
                </ul>
            </div>
            @if (Auth::check())      
                @if (Auth::user()->id == $project->user_id) 
                    <div class="btns" style="display: flex ; gap:20px">
                        <a href="/proposals/{{$project->id}}" class="btn delete">See Bids</a>
                        <form action="/delete-job" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$project->id}}">
                            <input type="submit" value="Remove" class="btn">
                        </form>
                    </div>
                @else
                    <a href="/submit/{{$project->id}}" class="btn">Send Proposal</a>
                @endif
            @else
                <a href="/submit/{{$project->id}}" class="btn">Send Proposal</a>
            @endif
        </div>
        <!-- {/* End Job TiTle */} -->
        <!-- {/* Start Description And Nab */} -->
        <div class="details">
            <!-- {/* Start description */} -->
            <div class="description">
                <h6>Project detail</h6>
                <div class="text">
                    <p>{{ $project->bio }}</p>
                    <div class="faq">
                        <h4>Project frequently asked questions</h4>
                        <div class="data" style="display: none">
                            {{$project->faq}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- {/* End description */} -->
            <!-- {/* Start Nav */} -->
            <div class="nav">
                <div class="boxes">
                    <div class="box">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        <div class="text">
                            <p class="price">$<span class="min">{{$project->price_min}}</span> - $<span class="max">{{$project->price_max}}</span></p>
                            <p class="desc">Per hour rate for estimated 40 hours</p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="fa-solid fa-language"></i>
                        <div class="text">
                            <p class="price">English Level</p>
                            <p class="desc">{{$project->english_level}}</p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="fa-solid fa-briefcase"></i>
                        <div class="text">
                            <a href="/proposals/{{$project->id}}">
                                <p class="price">{{count($proposals)}} Proposals</p>
                            </a>
                            <p class="desc">Received till {{ Carbon\Carbon::parse($project->created_at)->format('M d Y') }}</p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="fa-solid fa-briefcase"></i>
                        <div class="text">
                            @if ($project->status == 'completed')
                                <p class="price">The Project Completed Succfully</p>
                            @elseif ($project->status == 'rejected')
                                <p class="price" style="color: #f00">The Project Rejected !</p>
                            @else
                                @if ($project->freelancer)
                                    <p class="price">Active With {{App\Models\User::find($project->freelancer)->username}}</p>
                                @else 
                                    <p class="price">Not Have Freelancers</p>
                                @endif
                                <p class="desc">Project Status</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- {/* End Nav */} -->
        </div>
    </section>

    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->
    <script>
        const data = JSON.parse(document.querySelector('.data').innerHTML);

        if (!data) {
            document.querySelector('.faq').style.display = 'none';
        }

        data['questions'].forEach((q,index) => {
            createFAQ(q,data['answers'][index]);
        });

        function createFAQ(q,a) {
            const holder = document.createElement('div');
            holder.className = 'holder';

            const h3 = document.createElement('h3');
            h3.textContent = q;
            h3.className = 'question';

            const answerDiv = document.createElement('div');
            answerDiv.className = 'answer';

            const p = document.createElement('p');
            p.textContent = a;

            answerDiv.appendChild(p);

            holder.appendChild(h3);
            holder.appendChild(answerDiv);

            document.querySelector('.faq').appendChild(holder);
        }
    </script>
    <script src="{{asset('js/faq.js')}}"></script>
</body>
</html>