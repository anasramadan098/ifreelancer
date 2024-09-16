<!-- Sign Up Box -->
<div class="join">
    <div class="text">
        <i class="fa-solid fa-x close"></i>
        <h2>Join For a Good Start</h2>
        <p>Consectetur adipisicing elit sed dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina</p>
        <ul class="steps">
            <li class="active">01</li>
            <div class="line"></div>
            <li>02</li>
            <div class="line"></div>
            <li>03</li>
        </ul>
    </div>
    <form action="/join" method="POST">
        @csrf
        <div class="step-1">
            <div class="input">
                <select name="gender" @required(true)>
                    <option value="mr" selected>Mr</option>
                    <option value="mrs">Miss</option>
                </select>
                <input type="text" name="firstName" placeholder="First Name" @required(true)>
            </div>
            <input type="text" placeholder="Last Name" name="lastName" @required(true)>
            <div class="input">
                <input type="text" name="username" placeholder="Username" @required(true)>
            </div>
            <input type="email" name="email" placeholder="Email" @required(true)>
            <input type="tel" name="phone" placeholder="Phone Number" @required(true)>
            <button class="btn next">Start Now</button>
        </div>
        {{-- <div class="step-2" style="display: none">
            <input type="password" @required(true) name="password" placeholder="Write Your New Paswword">
            <input type="password" @required(true) placeholder="Confirm Your New Paswword">
            <a class="btn back">Back</a>
            <button class="btn next">Contiune</button>
        </div> --}}
    </form>
    <p>Already have an account? <a class="signInShowBtn" href="#">Sign In</a></p>
</div>
<div class="log">
        <div class="head">
            <h2>Log In</h2>
            <i class="fa-solid fa-x close"></i>
        </div>
        <form action="/login" method="POST">
            @csrf
            <input type="text" required name="emailOruser" placeholder="Type Email Or Username">
            <input type="password" required name="password" placeholder="Type Password">
            <button class="btn">login</button>
        </form>
        <p>
            Consectetur Adipisicing Elit Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua Enim Ad Minim Veniam Quis. <a href="#">Terms & Conditions</a>
        </p>
        <div class="adds">
            <a href="/forgetPassword">Forgot Password?</a>
            <p>Not A Member? <a href="#" style="margin-left: 5px" class="signUpShowBtn"> Sign Up </a></p>
        </div>
</div>



<div class="overlay"></div>



<header class="">
    <img src="{{asset('imgs/logo.png')}}" onclick="location.href = '/'" class="logo" alt="Logo">
    <div class="burger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
    <div class="my_links">
        <ul>
            <li>
                <a href="/">
            @if (!auth()->check()) 
                    Home
            @else 
                    {{Auth::user()->username}} Page
            @endif
            </a>
            </li>
            <li>
                <a href="/how">How It Works?</a>
            </li>
            <li>
                <a href="/jobs">Browse Jobs</a>
            </li>
            @if (!auth()->check()) 
                <li>
                    <a href="/#categories">See Categories</a>
                </li>
            @endif
            <li>
                <a href="/freelancers">View Freelancers</a>
            </li>
            @auth
                <li>
                    <a href="/inbox">Inbox </a>
                </li>
            @endif
        </ul>

        @auth
        <ul class="icons">
            <li>
                <a href="/wishlist">
                    <i class="fa-solid fa-heart"></i>
                </a>
            </li>
            <li>
                {{-- Notification --}}
                <i class="fa-solid fa-bell notificationBtn"></i>

                <div class="all-notification" >
                    <?php 
                        // get notification if receiver_id or sender_id is auth->id and with deacending order and get 5 only
                        // $notifications = DB::table('notifications')->where('receiver_id', Auth::user()->id)->orderBy('created_at', 'desc')->limit(5)->get();   
                        $notifications = DB::table('notifications')->where('receiver_id', Auth::user()->id)->orWhere('sender_id', Auth::user()->id)->orderBy('created_at', 'desc')->limit(5)->get();   
                    ?>
                    <!-- Notification -->
                    @foreach ($notifications as $notification)

                        <div class="notification">
                            <?php $user = App\Models\User::find($notification->sender_id); ?>
                            {{-- Img --}}
                                <img src="{{asset("$user->img")}}" alt="{{$user->full_name}} Image">
                            {{-- End Img --}}
                            <div class="text">
                                <p>
                                    {{-- Insert Content  In HTML --}}
                                    <?php echo $notification->content ?>
                                </p>
                                <div class="time">
                                    {{-- Calculate Time--}}
                                    <span>
                                        {{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}
                                    </span>
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </li>
        </ul>
        @endif

        <div class="btns">
            @if (!auth()->check())
                <a href="#" onclick="showJoinDiv()" class="btn">Join Now</a>
                <a href="#" onclick="showLogDiv()" class="btn">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Sign In
                </a>
            @else
                <form action="/signOut" method="POST">
                    @csrf
                    <input type="submit" class="btn" value="Sign Out" />
                </form>
            @endif
        </div>
    </div>
</header>


<div class="alerts">

</div>


<script src="{{asset('js/header.js')}}"></script>
<script>
        @if ($errors->any())
            @foreach ($errors->all() as $index => $error)
                // Create Alert
                const alert_{{$index}} = document.createElement('div');
                alert_{{$index}}.className = 'alert';
                alert_{{$index}}.textContent = "{{$error}}";
                // Append
                document.querySelector('.alerts').appendChild(alert_{{$index}});
                setTimeout(() => {
                    alert_{{$index}}.classList.add('hide');
                    setTimeout(() => {
                        alert_{{$index}}.remove();
                    }, 2000);
                }, 3000);
            @endforeach
            document.querySelector('header a.btn:last-child').click();
    @endif
</script>

