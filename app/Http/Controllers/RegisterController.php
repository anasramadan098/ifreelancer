<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{

    public function joinUs(Request $request)
    {

        $request->validate([
            'gender' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
        ]);

        // If validation fails, redirect back with errors
        if ($request->has('errors')) {
            return redirect()->back()->withErrors($request->errors()); // Redirect back with errors
        }

        $user = new User();
        $user->gender = $request->gender;
        $user->full_name = $request->firstName .' '. $request->lastName;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;


        return view('auth.secondeJoin',compact('user'));
    }
    public function addPassword(Request $request) {
        // Assuming you're passing the user data directly from the previous step
        $user = json_decode($request->user); // No need for json_decode

        $user->password = bcrypt($request->password); 

        return view('auth.lastStep', [ 
            'user' => $user,
            'categories' => config('categories'),
        ]);
    }
    public function save(Request $request) {
        // Assuming you're passing the user data directly from the previous step
        $the_user = json_decode($request->user); // No need for json_decode

        // Create a new User instance
        $user = new User();
        
        // Set the user attributes from the provided data
        $user->gender = $the_user->gender;
        $user->full_name = $the_user->full_name;
        $user->username = $the_user->username;
        $user->email = $the_user->email;
        $user->phone = $the_user->phone;
        $user->password = $the_user->password; // Password is already hashed

        // New Data
        $user->job_title = $request->job_title;
        $user->category = $request->category;
        $user->type = $request->is_freelancer;
        $user->freelancer_type = $request->freelancer_type;
        $user->english_level = $request->english_level;
        $user->country = $request->country;
        $user->bio = $request->bio;

        // Save the user to the database
        $user->save();

        // Log the user in
        Auth::login($user);

        return redirect('/me');
    }
}
