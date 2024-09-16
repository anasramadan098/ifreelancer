<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('title' , 'Add Password')
    @section('adds')

    @endsection
<body>

    <!-- Sign Up Box -->
<div class="join secondePassword" style="display: block">
    <div class="text">
        <h2>Congratulation !</h2>
        <p>This Is The Next Step That help you to add your <b>Strong</b> Password</p>
        <p>You Must Write Confirmition Password and password don't less than 8-digits</p>
        <ul class="steps">
            <li class="active">01</li>
            <div class="line"></div>
            <li class="active">02</li>
            <div class="line"></div>
            <li>03</li>
        </ul>
        <div class="alerts">
        </div>
    </div>
    <form action="/add-password" method="POST">
        @csrf
        <div class="step-2">
            <input type="password" required name="password" placeholder="Write Your New Paswword">
            <input type="password" style="margin-bottom: 30px" name="confirm_password" required placeholder="Confirm Your New Paswword">
            <input type="hidden" name="user" value="{{$user}}">
            <a onclick="history.back()" class="btn back">Back</a>
            <button class="btn next">Contiune</button>
        </div>
    </form>
</div>
    <script src="{{asset('js/confirmpassword.js')}}"></script>
</body>
</html>