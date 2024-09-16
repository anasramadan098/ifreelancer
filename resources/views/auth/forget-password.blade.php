<!DOCTYPE html>
<html lang="en">
<head>
    @extends('components.head')
    @section('title' , 'Forget Password')
    @section('adds')
        <link rel="stylesheet" href="{{asset('css/passwordForget.css')}}">
    @endsection
</head>
<body>
    <form action="/forgetPassword" method="POST">
        @csrf
        
        <img onclick="location.href = '/' " src="{{asset('imgs/logo.png')}}" alt="logo">
        <h2>Forgot password</h2>
        <p>If you have an account? <a href="/?signIn=yes">Sign In</a></p>
        <input type="email" name="email" placeholder="Email">
        <button>Get Password</button>

        <div class="msg">
            {{$msg}}
        </div>

    </form>
</body>
</html>