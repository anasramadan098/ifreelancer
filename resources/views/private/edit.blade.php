<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('title' , 'Edit Info')
    @section('adds')
        <link rel="stylesheet" href="{{ asset('css/freelaner-personal.css') }}">
        <link rel="stylesheet" href="{{ asset('css/add-skill.css') }}">
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
                    top:5%;
                    right:5%;
                    cursor:pointer;
                }
            }  
            .add-btn-div {
                display: flex;
                justify-content:space-between;
                width:100%
            }
            input {
                width: 100%;
            }
            .info-list {
                li {
                    min-width: 100px;
                }
            }
            .info {
                .img {
                    max-width: 25%;
                    align-items:baseline;
                }
            }            
            textarea {
                min-width: 500px;
                resize:vertical;
                min-height: 250px;
                margin-top: 30px;
                line-height: 2
            }
            .rates {
                padding: 20px;
                select {
                    width:100%;
                    margin-bottom:30px;
                }
                .input {
                    display: flex;
                    gap: 5px;
                    margin-top: 10px;
                    align-items: center;
                    input[type="radio"] {
                        padding:0 !important;
                    }
                }
            }
        </style>
    @endsection
<body>
    <!-- Start Header -->
    @extends('components.header')
    <!-- End Header -->
    <div class="freelancer-bg bg"></div>
    <form action="/uptade" method="POST" class="sureForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="info">
            <div class="img">
                <img src="{{asset("$user->img")}}" alt="{{$user->full_name}} Image">
                {{-- @if ($user->img != 'freelancer.jpg')
                    <img src='{{asset("profileImgs/" . $user->username ."/". $user->username .".jpg")}}' alt="freelancer">
                @else
                    <img src='{{asset("profileImgs/defult.jpg")}}' alt="freelancer">
                @endif --}}
                <div class="input">
                    <label for="img">Uplode Image (225x225)</label>
                    <input type="file" name="img" id="img" accept=".jpeg">
                </div>
                <p class="name">
                    <i class="fa-solid fa-certificate"></i>
                    <a href="#">{{$user->full_name}}</a>
                </p>
                <input type="text" name="full_name" placeholder="Write Your New Name">
            </div>
            <div class="text">
                <ul class="info-list">

                    <h2>{{$user->job_title}}</h2>
                    <input type="text" name="job_title" placeholder="Your Job Title">

                </ul>
                <ul class="info-list">
                    <li>
                        <i class="fa-solid fa-money-bill"></i>
                        <p>$<span class="price">{{ $user->hourly_price }}</span>  / hr</p>
                    </li>
                    <li>
                        <input type="number" name="hourly_price" min="10" value="{{$user->hourly_price}}" placeholder="Write Your Hourly Rate">
                    </li>
                </ul>
                <ul class="info-list">
                    <li>
                        <img src="../imgs/usa.png" alt="">
                        <p>{{$user->country}}</p>
                    </li>
                    <li>
                        <select id="country-select" name="country" data-value='{{$user->country}}'>
                            <optgroup label="Arab Countries">
                            <option value="AF">Afghanistan</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="EG">Egypt</option>
                            <option value="IQ">Iraq</option>
                            <option value="JO">Jordan</option>
                            <option value="KW">Kuwait</option>
                            <option value="LB">Lebanon</option>
                            <option value="LY">Libya</option>
                            <option value="MA">Morocco</option>
                            <option value="MR">Mauritania</option>
                            <option value="OM">Oman</option>
                            <option value="PS">Palestine</option>
                            <option value="QA">Qatar</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SO">Somalia</option>
                            <option value="SD">Sudan</option>
                            <option value="SY">Syria</option>
                            <option value="TN">Tunisia</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="YE">Yemen</option>
                            </optgroup>
                            <optgroup label="Not Arab Countries">
                            <option value="USA">United States</option>
                            <option value="GR">German</option>
                            <option value="In">India</option>
                            <option value="PA">Pakistan</option>
                            </optgroup>
                        </select>
                    </li>
                </ul>
                <textarea name="bio">{{$user->bio}} </textarea>
            </div>
            <div class="rates">
                <div class="box">
                    <select name="category" data-value="{{ $user->category }}">
                        <option value="" selected disabled>Your Category</option>
                        <option value="business">Business</option>
                        <option value="video-animation">Video & Animation</option>
                        <option value="programing">Promgraing & Tech</option>
                        <option value="design">Graphic Designer</option>
                    </select>
                </div>
                <div class="box">
                    <div class="radio" >
                        <h3>Your English Level?</h3>
                        <div class="radio-data" data-value="{{$user->english_level}}"></div>
                        <div class="inputs">
                            <div class="input">
                                <input type="radio" name="english_level" value="basic" id="basic">
                                <label for="basic">Basic</label>
                            </div>
                            <div class="input">
                                <input type="radio" name="english_level" value="conversational" id="conversational">
                                <label for="conversational">Conversational</label>
                            </div>
                            <div class="input">
                                <input type="radio" name="english_level" value="fluent" id="fluent">
                                <label for="fluent">Fluent</label>
                            </div>
                            <div class="input">
                                <input type="radio" name="english_level" value="professional" id="professional">
                                <label for="professional">Professional</label>
                            </div>
                            <div class="input">
                                <input type="radio" name="english_level" value="native" id="native">
                                <label for="native">Native</label>
                            </div>
                        </div>
                    </div>
                </div>
                <input class="btn sureBtn" type="submit"  value="Save Edits ✔✨">
            </div>

            <input type="hidden" name="skills" value="{{json_encode($user->skills)}}">

        </div>     
    </form>

        <div class="skills editPageSkills" style="padding: 250px 60px 60px;">
            <div class="title">
                <h2>Add Skills Section</h2>
                <h5>Here That Can Add Unlimited Skills And Put Your Level In It</h5>
            </div>
            {{-- Selected Skills --}}
            <ul class="selected-skills">

            </ul>
            {{-- Search Input --}}
            <input type="search" class="skillsSearch" placeholder="Type Your Skill">
            {{-- All Skills --}}
            <ul class="all-skills">
                @foreach (config('skills') as $skill)
                    <li>{{$skill}}</li>
                @endforeach

            </ul>

        </div>
    <script src="{{asset('js/getTheSelected.js')}}"></script>
    <script src="{{ asset('/js/add-skills.js') }}"></script>
    <script src="{{ asset('/js/sure.js') }}"></script>
    @if (count(json_decode($user->skills)) > 0)
        <script>
            @foreach (json_decode($user->skills) as $skill)
                createLisFrom('{{$skill->name}}', '{{$skill->percentage}}');
                checkIfElementFound('{{$skill->name}}');
            @endforeach
        </script>
    @endif
    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->
</body>
</html>