<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('title' , 'Send Proposal Page')
    @section('adds')
        <link rel="stylesheet" href="{{asset('css/proposal.css')}}">    
    @endsection
<body>
        <!-- Start Header -->
        @extends('components.header')
        <!-- End Header -->
        <div class="bg">
            <h1>Submit Proposal</h1>
            <p><a href="/">Home</a> / <span>Submit Proposal</span></p>
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
            <form action="/save-proposal-to/{{$project->id}}" class="sureForm" method='POST'>
                @csrf
                <h2>Proposal Amount</h2>
                <div class='inputs'>
                    <div class='flex'>
                        <div class="prices">
                            <input type="number" onInput={calculateFee} min={5n} placeholder='Enter Your Per Hour Rate' required name="hour_rate"/>
                            <input type="number" placeholder='Estimated hours' required name="hours"/>
                            <i>Total amount the client will see on your proposal</i>
                        </div>
                        <div class='arrow'>
                            <i class="fa-solid fa-arrow-down"></i>
                        </div>
                    </div>
                    <div class="calculates">
                        <div>
                            <p ><span class='italic'>(<span class='icon'>$</span>)  </span><span class="myPrice"></span></p>
                            <p>Your proposed hourly rate</p>
                        </div>
                        <div>
                            <p><span class='italic'>(<span class='icon'>$</span>)  -  </span><span class="fee"></span></p>
                            <p>Service fee</p>
                        </div>
                        <div>
                            <p><span class='italic'>(<span class='icon'>$</span>)  </span><span class="finaly"></span></p>
                            <p>Hourly price, You’ll receive after  fee deduction</p>
                        </div>
                    </div>
                </div>
                <div class='others'>
                    <textarea name='description' required placeholder='Description *'></textarea>
                    {{-- <div class='files'>
                        <input type='file' name='files' class='btn' placeholder='Select File' />
                        <p>Drop files here to upload</p>
                    </div> --}}
                    <button class='btn sureBtn'>Send Now</button>
                </div>
            </form>
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
        <script src="{{ asset('/js/sure.js') }}"></script>

</body>
</html>