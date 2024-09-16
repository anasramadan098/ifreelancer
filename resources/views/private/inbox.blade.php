<!DOCTYPE html>
<html lang="en">
<head>
    @extends('components.head')
    @section('title' , 'Inbox')
    @section('adds')
        <link rel="stylesheet" href="{{asset('css/inbox.css')}}">
    @endsection
</head>
<body>
    <!-- Start Header -->
    @extends('components.header')
    <!-- End Header -->
    <div class="freelancer-bg bg">
        <h1>Inbox</h1>
        <p><a href="/">Home</a> / <span>Inbox</span></p>
    </div>
    <section class="holder inbox-holder">
        <div class="msgs">
            <h2>Message</h2>
            <div class="btns ps">
                <button class="btn active">All</button>
                <button class="btn unreadedBtn">Unread</button>
            </div>
            

            @foreach ($conversations as $msg)
                    <?php
                        $unreaded = 0;
                        foreach (json_decode($msg->messages) as $key => $object) {
                            if ($object->sender != Auth::user()->id) {
                                if ($object->seen == false) {
                                    $unreaded++;
                                }
                            }
                        }  
                        $user = App\Models\User::find($msg->freelancer_id);
                        $jobOnwer = App\Models\User::find($msg->job_owner_id);
                    ?>
                    <div class="box ps" onclick="location.search = '?conv={{$msg->id}}'" data-unread="{{$msg->seen ? 'false' : 'true'}}">
                        @if (Auth::user()->id != $msg->freelancer_id)

                            {{-- Img --}}
                                <img src="{{asset("$user->img")}}" alt="{{$user->full_name}} Image">
                            {{-- End Img --}}

                        <div class="text">
                            <h3>
                                {{ $user->full_name }}
                            </h3>
                        @else
                            {{-- Img --}}
                                <img src="{{asset("$jobOnwer->img")}}" alt="{{$jobOnwer->full_name}} Image">
                        <div class="text">
                            <h3>
                                {{ $jobOnwer->full_name }}
                            </h3>
                        @endif
                            {{-- Content --}}
                            <p>{{ $msg->id }}</p>
                            <span class="project-name">
                                <i class="fa-solid fa-building"></i>
                                {{-- <span> {{App\Models\Job::find($msg->project_id)}} </span> --}}
                            </span>
                        </div>
                        @if ($unreaded > 0)
                            <span class="number-of-msgs">{{ $unreaded }}</span>
                        @endif

                        <span class="time">{{ $msg->updated_at->diffForHumans()}}</span>
                    </div>
            @endforeach
        </div>
        <div class="msg-holder">
                @if (request()->has('conv'))
                    {{-- PHP Code --}}
                        <?php  $user = App\Models\User::find($conversation->freelancer_id);  ?>
                    {{-- End PHP Code --}}

                    <div class="head">
                            <div class="text">
                                {{-- Img --}}
                                    <img src="{{asset("$user->img")}}" alt="{{$user->full_name}} Image">
                                {{-- End Img --}}
                                <h3>
                                    <a href="/freelancers/{{$user->id}}">
                                        {{ $user->full_name }}
                                    </a>
                                </h3>
                            </div>
                        @if (Auth::user()->id == $conversation->job_owner_id)
                            {{-- Start PHP --}}
                                <?php 
                                    $job = App\Models\Job::find($conversation->project_id);
                                ?>
                            {{-- End PHP --}}
                            <div class="actions">
                                @if (!$job->freelancer)
                                {{-- Accept Proposal --}}
                                    <a class="sureBtn btn" href="/accept-proposal/{{App\Models\Proposal::where('project_id', $conversation->project_id)->first()->id}}">Acept</a>
                                    <a class="sureBtn btn delete" href="/reject-proposal/{{App\Models\Proposal::where('project_id', $conversation->project_id)->first()->id}}">Reject</a>       
                                @else 

                                    @if ($job->freelancer == $conversation->freelancer_id)

                                        @if ($job->status == 'completed') 
                                            {{-- The Project Done--}}
                                            <a class="btn">The Project Was Recived</a>
                                        @else 
                                            {{-- Recive Project --}}
                                            <a class="sureBtn btn" href="/rate-project/{{App\Models\Proposal::where('project_id', $conversation->project_id)->first()->id}}">Recive Project</a>
                                            <a class="sureBtn btn delete" href="/cancel-proposal/{{App\Models\Proposal::where('project_id', $conversation->project_id)->first()->id}}">Cancel Project</a>
                                        @endif
                                        
                                    @endif
                                </div>
                                @endif
                    @endif
                    </div>
 
                    <div class="body">
                        @if (count(json_decode($conversation->messages)) > 0 )
                            @foreach (json_decode($conversation->messages) as $msg)
                                <div class="msg {{ $msg->sender == Auth::user()->id ? 'me' : '' }}">
                                    {{-- Img --}}
                                        <?php $userMsg =  App\Models\User::find($msg->sender); ?>
                                        <img src="{{asset("$userMsg->img")}}" alt="{{$userMsg->full_name}} Image">
                                    {{-- End Img --}}
                                    <div class="text">
                                        <p> {{$msg->content}} </p>
                                        <span class="date">{{ $msg->created_at }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="select">Don't Have Messages Yet</p>
                        @endif
                    </div>
                    <div class="send">
                        <form action="/send-message" method="post">
                            @csrf
                            <input type="text" name="msg" placeholder="Type a message...">
                            <input type="hidden" name="r" value="{{$conversation->freelancer_id}}">
                            <input type="hidden" name="mc" value="{{$conversation->id}}">
                            <button class="btn">Send</button>
                        </form>
                    </div>
                @else
                    <p class="select">Select A Chat</p>
                @endif
        </div>

    </section>
    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->
    {{-- <script>
        const conversationId = {{ $conversation->id }};
        const userId = {{ Auth::user()->id }};
    </script> --}}
    <script src="{{ asset('js/inbox.js') }}"></script>
    {{-- <script src="{{asset('js/inbox.js')}}"></script> --}}
    <script src="{{ asset('/js/sure.js') }}"></script>
</body>
</html>