<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // $credentials = $request->only('email', 'password');

        if (Auth::attempt(['email' => $request->emailOruser,'password' => $request->password])) {
            return redirect('/me');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }

    }
}