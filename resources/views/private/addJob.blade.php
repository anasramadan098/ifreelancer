<!DOCTYPE html>
<html lang="en">
<head>
    @extends('components.head')
    @section('title' , 'Add Project')
    @section('adds')
        <link rel="stylesheet" href="{{ asset('css/freelaner-personal.css') }}">
        <link rel="stylesheet" href="{{ asset('css/add-skill.css') }}">
        <link rel="stylesheet" href="{{ asset('css/add-job.css') }}">
    @endsection
</head>
<body>
    <!-- Start Header -->
    @extends('components.header')
    <!-- End Header -->
    <div class="freelancer-bg bg"></div>
    <section>
        <div class="title">
          @if ($user)
            <h2>Add project to {{ $user->username }}</h2>
            @else
            <h2>Add project</h2>
          @endif
          <h5>Add Your All project Data</h5>
        </div>
        @if ($user)
          <form action="/save-job?user={{$user->id}}" class="sureForm" method="POST">
        @else
          <form action="/save-job" class="sureForm" method="POST">
        @endif
            @csrf
            {{-- Name --}}
            <div class="input">
                <input required type="text" name="project_name" placeholder="Write Your project Name">
            </div>
            {{-- Price --}}
            <div class="inputs">
                <h3>Price</h3>
                  <div class="input">
                        <input required type="radio" name="radio_price" value="fixed" id="fixed" />
                        <label for="fixed">Fixed</label>
                  </div>
                  <div class="input">
                    <input required type="radio" name="radio_price" value="hourly" id="hourly" />
                    <label for="hourly">Hourly</label>
                  </div>
                <div class="input required prices">
                    <input
                      type="number"
                      value="1"
                      min="1"
                      max="1000"
                      name="priceMin"
                      class="min"
                      required
                    />
                    <input
                      type="number"
                      min="1"
                      value="900"
                      max="1000"
                      name="priceMax"
                      class="max"
                      required
                    />
                  </div>
            </div>
            {{-- Category --}}
            <div class="inputs">
                <h3>Category</h3>
                @foreach (config('categories') as $category)
                  <div class="input">
                      <input required type="radio" name="project_category" value="{{$category}}" id="{{$category}}" />
                      <label for="{{$category}}">{{  str_replace( '-', ' ', trim( ucwords( strtolower( $category ) ) ) )  }}</label>
                  </div>
                @endforeach
            </div>
            {{-- English --}}
            <div class="inputs" >
                <h3>English</h3>
                <div class="input">
                  <input required type="radio" id="basic" value="basic" name="english_level" />
                  <label for="basic">Basic</label>
                </div>
                <div class="input">
                  <input required type="radio" id="conversational" name="english_level" value="conversational" />
                  <label for="conversational">Conversational</label>
                </div>
                <div class="input">
                  <input required type="radio" id="fluent" value="fluent" name="english_level" />
                  <label for="fluent">Fluent</label>
                </div>
                <div class="input">
                  <input required type="radio" id="native-or-bilingual" value="native-or-bilingual" name="english_level" />
                  <label for="native-or-bilingual">Native</label>
                </div>
                <div class="input">
                  <input required type="radio" value="professional" id="professional" name="english_level" />
                  <label for="professional">Professional</label>
                </div>
            </div>
            {{-- project Type --}}
            <div class="inputs">
                <h3>project Type</h3>
                <div class="input">
                  <input required type="radio"  id="onsite" value="onsite" name="type" />
                  <label for="onsite">Onsite</label>
                </div>
                <div class="input">
                  <input required type="radio" id="partial" value="partial" name="type" />
                  <label for="partial">Partial Onsite</label>
                </div>
                <div class="input">
                  <input required type="radio" id="remote" value="remote" name="type" />
                  <label for="remote">Remote</label>
                </div>
            </div>
            {{-- Length --}}
            <div class="inputs">
                <h3>Length</h3>
                <div class="input">
                  <input
                    type="radio"
                    id="Less than a week"
                    value="Less than a week"
                    name="project_length"
                    required
                  />
                  <label for="Less than a week">Less than a week</label>
                </div>
                <div class="input">
                  <input
                    type="radio"
                    id="Less than a month"
                    value="Less than a month"
                    name="project_length"
                    required
                  />
                  <label for="Less than a month">Less than a month</label>
                </div>
                <div class="input">
                  <input
                    type="radio"
                    id="01 to 03 months"
                    value="01 to 03 months"
                    name="project_length"
                    required
                  />
                  <label for="01 to 03 months">01 to 03 months</label>
                </div>
                <div class="input">
                  <input
                    type="radio"
                    id="03 to 06 months"
                    value="03 to 06 months"
                    name="project_length"
                    required
                  />
                  <label for="03 to 06 months">03 to 06 months</label>
                </div>
                <div class="input">
                  <input
                    type="radio"
                    id="More than 06 months"
                    value="More than 06 months"
                    name="project_length"
                    required
                  />
                  <label for="More than 06 months">More than 06 months</label>
                </div>
            </div>
            {{-- Skills --}}
            <div class="inputs skills">
                <h3>Skills</h3>
                <input required type="hidden" name="skills">
                {{-- Selected Skills --}}
                <ul class="selected-skills no-per">

                </ul>
                {{-- Search input required --}}
                <input  type="search" class="skillsSearch" placeholder="Type Your Skill">
                {{-- All Skills --}}
                <ul class="all-skills">
                  @foreach (config('skills') as $skill)
                    <li>{{$skill}}</li>
                  @endforeach
                </ul>
            </div>
            {{-- Bio --}}
            <textarea required name="bio" placeholder="Project Details"></textarea>
            {{-- FAQ --}}
            <div class="inputs faqs">
                <h3>Add FAQ</h3>
                <div class="input">
                    <input  type="text" name="questions[]" placeholder="Question">
                    <input  type="text" name="answers[]" placeholder="Answer">
                    <a class="btn"  onclick="createFaqBox()">Add More</a>
                </div>
            </div>
            {{-- Submit --}}
            <input type="submit" class="btn sureBtn" value="Post Project">    
        </form>
    </section>
    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->
    <script>
        function createFaqBox() {
            const div = document.createElement('div');
            div.className = 'input';

            // Question
            const questioninput = document.createElement('input');
            questioninput.name = 'questions[]';
            questioninput.placeholder = 'Question';

            
            // Answer
            const answerinput  = document.createElement('input');
            answerinput.name = 'answers[]';
            answerinput.placeholder = 'answer';


            // Add More
            const a = document.createElement('a');
            a.className = 'btn'
            a.onclick = function () {
                createFaqBox();
            }
            a.textContent = 'Add More';

            // Remove
            const remove = document.createElement('a');
            remove.className = 'btn';
            remove.textContent = 'Remove';
            remove.onclick = function () {
              div.remove();
            }


            // Append
            div.appendChild(questioninput);
            div.appendChild(answerinput);
            div.appendChild(a);
            div.appendChild(remove);
            document.querySelector('.faqs').appendChild(div);
        }
    </script>
    <script src="{{ asset('/js/sure.js') }}"></script>

    <script src="{{ asset('/js/add-skills.js') }}"></script>
</body>
</html>