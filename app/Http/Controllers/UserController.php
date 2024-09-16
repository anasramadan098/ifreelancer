<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function joinUs(Request $request)
    {
        $user = new User();
        $user->gender = $request->gender;
        $user->full_name = $request->firstName .' '. $request->lastName;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;


        return view('auth.secondeJoin',compact('user'));
    }
    public function addPassword(Request $request) {
        $user = json_decode($request->user);
        $user->password = bcrypt($request->password);

        return view('auth.lastStep',compact('user'));
    }
    public function save(Request $request) {
        $data = json_decode($request->user);

        // Create a new User instance
        $user = new User();

        // Set the user attributes from the provided data
        $user->gender = $data->gender;
        $user->full_name = $data->full_name;
        $user->username = $data->username;
        $user->email = $data->email;
        $user->phone = $data->phone;
        $user->password = $data->password; // Assuming password is already hashed
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



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
