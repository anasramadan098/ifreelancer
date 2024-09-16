<!DOCTYPE html>
<html lang="en">
@extends('components.head')
@section('title' , 'Feedback')
@section('adds')
    <style>
        .feedbacks {
            padding: 150px 30px;
            h1 {
                text-align:center; 
                font-size: 40px;
                strong {
                    color: var(--seconde-color);
                }
            }
            > p {
                margin-top: 20px;
                text-align: center;
                color: #777;
                font-size: 4em;
            }
            .feedback {
                margin-bottom: 20px;
                padding: 20px;
                background-color: #f7f7f7;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                transition: background-color 0.3s ease;
                &:hover {
                    background-color: #f5f5f5;
                }
                .feedback-user {
                    display: flex;
                    align-items: center;
                    img {
                        width: 70px;
                        height: 70px;
                        border-radius: 50%;
                        object-fit: cover;
                        margin-right : 20px;
                    }
                    span {
                        font-size: 1.2em;
                        color: #333;
                    }
                }
                .feedback-content {
                    padding: 20px;
                    font-size: 1.5em;
                    line-height: 1.5;
                    .stars {
                        i {
                            color: #FFA500;
                            margin-right: 5px;
                            cursor: pointer;
                            transition: color 0.3s ease;
                            &.fill:hover {
                                color: #FFD700;
                            }
                        }
                    }
                }
                .feedback-date {
                    font-size: 1em;
                    color: #999;
                    margin-top: 10px;
                }


            }
        }
    </style>
    <script>
        document.querySelector('header').classList.add('scrolled')
    </script>
@endsection
<body>
    <!-- Start Header -->
    @extends('components.header')
    <!-- End Header -->
    
    <section class="feedbacks">
        <h1>Feedbacks For <br>
            <strong>{{$user->full_name}}</strong>
        </h1>
        <div class="feedbacks">

            @if (count(json_decode($user->feedbacks)))
                @foreach (json_decode($user->feedbacks) as $feedback)
        
                    <div class="feedback">
                        <div class="feedback-user">
                            <?php 
                                $feedbackUser = App\Models\User::find($feedback->user_id);
                            ?>
                                <img src='{{asset("$feedbackUser->img")}}' alt="{{$feedbackUser->full_name}} freelancer">
                                <a href="/freelancers/{{$feedbackUser->user_id}}">
                                    <span>{{ $feedbackUser->full_name }}</span>
                                </a>
                        </div>
                        <div class="feedback-content">
                            <p>
                                {{ $feedback->content }}
                            </p>
                            {{-- Stars By Loop --}}
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $feedback->stars)
                                        <i class="fas fa-star fill"></i>
                                    @else
                                    <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            
                            

                        </div>
                        <div class="feedback-date">
                            {{ Carbon\Carbon::parse($feedback->created_at)->format('Y-m-d') }}
                        </div>
                    </div>
                @endforeach
            @else 
            <p>No feedbacks found for this user.</p>

            @endif

        </div>
    </section>



    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->

</body>
</html>