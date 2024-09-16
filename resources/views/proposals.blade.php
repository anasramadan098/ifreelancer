<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('title')
        Proposals For Project "{{$project->name}}"
    @endsection
    @section('adds')
        <link rel="stylesheet" href="{{asset('css/proposal.css')}}">    
    @endsection
<body>
        <!-- Start Header -->
        @extends('components.header')
        <!-- End Header -->
        <div class="bg">
            <h1>Job Proposals</h1>
            <p><a href="/">Home</a> / <span>Job Proposals</span></p>
        </div>
        <section class='proposal'>
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
            </div>
            <div class="proposals">
                <div class="cards">
                    @if (count($proposals) > 0)
                        @foreach($proposals as $proposal)
                        <div class="card">
                            @if (App\Models\User::find($proposal->freelancer_id)->img != 'freelancer.jpg')
                                <img src='{{asset("profileImgs/" . App\Models\User::find($proposal->freelancer_id)->username ."/". App\Models\User::find($proposal->freelancer_id)->username .".jpg")}}' alt="freelancer">
                            @else
                                <img src='{{asset("profileImgs/defult.jpg")}}' alt="freelancer">
                            @endif
                            <div class="text">
                                <h3>{{App\Models\User::find($proposal->freelancer_id)->full_name}}</h3>
                                <p>{{$proposal->description}}</p>
                                <div class="price">
                                    <h4>Price: <span class="btn">{{$proposal->hour_rate}}</span> $</h4>
                                    <h4>Estilminated Hours: <span class="btn delete">{{$proposal->hours}}</span></h4>
                                </div>
                            </div>
                            @auth
                                @if(Auth::user()->id == $project->user_id)
                                    
                                        <div class="actions">
                                            <a href="/inbox-user/{{$proposal->id}}" class="btn">Chat With User</a>
                                            {{-- <a href="/reject-proposal/{{$proposal->id}}" class="btn delete">Reject</a> --}}
                                        </div>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        @endforeach
                    @else 
                        <p style="font-weight: bold; font-size:2em; color:#333;">No proposals yet</p>
                    @endif
                </div>
            
        </section>
        {{-- Footer --}}
        @extends('components.footer')
        {{-- Footer --}}

        <script>
            const priceInput = document.querySelector('input[name="hourPrice"]');
            let price = priceInput.value;

            priceInput.addEventListener('input',() => {
                price = priceInput.value;
                document.querySelector('span.myPrice').textContent = price;
                document.querySelector('span.fee').textContent = price * 20 / 100;
                document.querySelector('span.finaly').textContent = price - price * 20 / 100;
            })

            document.querySelector('.arrow').addEventListener('click',() => {
                document.querySelector('.calculates').classList.toggle('active');
            })

        </script>
</body>
</html>