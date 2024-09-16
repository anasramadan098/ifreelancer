<!DOCTYPE html>
<html lang="en">
<head>
    @extends('components.head')
    @section('title' , 'Reset Password Page')
    @section('adds')
        <link rel="stylesheet" href="{{asset('css/passwordForget.css')}}">
    @endsection
</head>
<body>
    <form action="/forget-password" method="POST">
        @csrf
        
        <img onclick="location.href = '/' " src="{{asset('imgs/logo.png')}}" alt="logo">
        <h2>Reset The Password</h2>
        <p>You have successfully verified your identity. Let's change your password</p>
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <input type="hidden" name="userToken" value="{{$userToken}}">
        <button>Reset Password</button>

        <div class="msg">
            {{$msg}}
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="msg">
                    {{$error}}
                </div>
            @endforeach
        @endif

    </form>
</body>
</html>