<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('title' , 'Add Last Info')
    @section('adds')
        <link rel="stylesheet" href="{{asset('css/lastStep.css')}}">
    @endsection
<body>

    <!-- Sign Up Box -->
<div class="join secondePassword" style="display: block">
    <div class="text">
        <h2>Good Job 😍✔</h2>
        <p>Fill This Form By All Info About You</p>
        <ul class="steps">
            <li class="active">01</li>
            <div class="line"></div>
            <li class="active">02</li>
            <div class="line"></div>
            <li class="active">03</li>
        </ul>
        <div class="alerts">
        </div>
    </div>
    <form action="/save" method="post">
        @csrf
        <div class="step-3">
            <input type="text" name="job_title" placeholder="Job Title">
            <select name="category" required>
                <option value="" selected disabled>Your Category</option>
                @foreach ($categories as $category)
                    <option value="{{$category}}">
                        {{  str_replace( '-', ' ', trim( ucwords( strtolower( $category ) ) ) )  }}

                    </option>

                @endforeach
            </select>
            <div class="radio">
                <h3>Who Are You?</h3>
                <div class="inputs">
                    <div class="input">
                        <input type="radio" required name="is_freelancer" value="freelancer" id="freelancer">
                        <label for="freelancer">Freelancer</label>
                    </div>
                    <div class="input">
                        <input type="radio" required name="is_freelancer" value="job_owner" id="job_owner">
                        <label for="job_owner">Job Owner</label>
                    </div>
                </div>
                <div class="isfreelancer" style="display:none; margin-top:15px;">
                    <h3>Your Freelancer Type?</h3>
                    <div class="inputs">
                        <div class="input">
                            <input type="radio" name="freelancer_type" required value="agency" id="agency">
                            <label for="agency">Agency</label>
                        </div>
                        <div class="input">
                            <input type="radio" name="freelancer_type" required value="independent" id="independent">
                            <label for="independent">Independent</label>
                        </div>
                        <div class="input">
                            <input type="radio" name="freelancer_type" required value="rising" id="rising">
                            <label for="rising">Rising</label>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="user" value="{{json_encode($user)}}">
            <div class="radio" >
                <h3>Your English Level?</h3>
                <div class="inputs">
                    <div class="input">
                        <input type="radio" required name="english_level" value="basic" id="basic">
                        <label for="basic">Basic</label>
                    </div>
                    <div class="input">
                        <input type="radio" required name="english_level" value="conversational" id="conversational">
                        <label for="conversational">Conversational</label>
                    </div>
                    <div class="input">
                        <input type="radio" required name="english_level" value="fluent" id="fluent">
                        <label for="fluent">Fluent</label>
                    </div>
                    <div class="input">
                        <input type="radio" required name="english_level" value="professional" id="professional">
                        <label for="professional">Professional</label>
                    </div>
                    <div class="input">
                        <input type="radio" required name="english_level" value="native" id="native">
                        <label for="native">Native</label>
                    </div>
                </div>
            </div>
            <select id="country-select" name="country" required>
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
            <textarea name="bio" style="resize:vertical;">Write Your Bio</textarea>
            <div class="btns">
                <a href="/" class="btn back">Back</a>
                <button class="btn next">Contiune</button>
            </div>
        </div>
    </form>
</div>


<script>
    const allFreelancerInputs = document.querySelectorAll('input[name="is_freelancer"]')
    const freelancerInput = document.querySelector('#freelancer')
    const isfreelancerDiv = document.querySelector('.isfreelancer')

    allFreelancerInputs.forEach(input => {
        input.addEventListener('change',() => {
            if (input.id == 'freelancer') {
                isfreelancerDiv.style.display = 'block'
            } else {
                isfreelancerDiv.style.display = 'none'
            }
        })
    })

</script>

</body>
</html>