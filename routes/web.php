<?php

// Mains
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;

// Models
use App\Models\Job;
use App\Models\User;
use App\Models\Message;
use App\Models\Proposal;
use App\Models\Conversation;

// Mails
use Illuminate\Support\Facades\Mail;
use App\Mail\passwordReset;


use Illuminate\Support\Str;

use App\Events\MessageSent;

use App\Http\Controllers\PayPalController;
use App\Models\Notification;

Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::post('/send-money', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
// Test
Route::get('/test', function () {
    $message = new Message();
    $message->content = 'Hello World!';
    $message->sender_id = 1;
    $message->receiver_id = 3;
    // $message->save();
    return User::find($message->receiver_id);
});













# Sign Up Form

// Route::get('join/{id}', [SignUpController::class, 'show'])->name('join.show');
// Route::put('join/update', [SignUpController::class, 'update'])->name('join.update');
Route::post('join/store', [SignUpController::class, 'store'])->name('join.store');
// Route::delete('join/destroy', [SignUpController::class, 'destroy'])->name('join.destroy');


Route::group(['middleware' => ['auth']], function () {
    // Protected routes here


    Route::get('/submit/{id}', function ($id) {
        return view('submitProposal',
        [
            'project' => Job::find($id),
        ]);
    });
    // Me Page
    Route::get('/me', function () {
        return view('private.freelancerPage',[
            'user' => Auth::user(),
            'jobs' => Job::where('user_id',Auth::user()->id)->get(),
        ]);
    })->name('mePage');

    // Wishlist Actions
    Route::get('/wishlist' , function () {
        return view('private.wishlist' , [
            'wishlist' => json_decode(Auth::user()->wishlist)
        ]);
    });

    // Jobs
    Route::get('/save-job/{id}' , function ($id) {
        $user = Auth::user();
        $wishlist = json_decode($user->wishlist);

        // Check If Added Before
        if (in_array(['id' => $id , 'title' => Job::find($id)->name], $wishlist->jobs)) {
            return redirect()->back()->withErrors(['Already Added To Wishlist']);
        }

        // Add To Wishlist
        $wishlist->jobs[] = ['id' => $id , 'title' => Job::find($id)->name];
        $user->wishlist = json_encode($wishlist);
        $user->save();

        return redirect()->back()->withErrors(['Save To Wishlist']);
    });
    Route::post('/destroy-job/{id}' , function ($id) {
        $user = Auth::user();
        $wishlist = json_decode($user->wishlist);

        // Remove From Wishlist
        $key = array_search(['id' => $id , 'title' => Job::find($id)->name], $wishlist->jobs);
        unset($wishlist->jobs[$key]);
        $user->wishlist = json_encode($wishlist);
        $user->save();

        return redirect()->back()->withErrors(['Remove From Wishlist']);
    });

    // Users
    Route::get('/save-user/{id}' , function ($id) {
        $user = Auth::user();
        $wishlist = json_decode($user->wishlist);

        // Check If Added Before
        if (in_array(['id' => $id , 'title' => User::find($id)->full_name], $wishlist->users)) {
            return redirect()->back()->withErrors(['Already Added To Wishlist']);
        }

        // Add To Wishlist
        $wishlist->users[] = ['id' => $id , 'title' => User::find($id)->full_name];
        $user->wishlist = json_encode($wishlist);
        $user->save();

        return redirect()->back()->withErrors(['Save To Wishlist']);
    });
    Route::post('/destroy-user/{id}' , function ($id) {
        $user = Auth::user();
        $wishlist = json_decode($user->wishlist);

        // Remove From Wishlist
        $key = array_search(['id' => $id , 'title' => Job::find($id)->name], $wishlist->users);
        unset($wishlist->users[$key]);
        $user->wishlist = json_encode($wishlist);
        $user->save();

        return redirect()->back()->withErrors(['Remove From Wishlist']);
    });


    // Edit Me Page
    Route::get('/me/edit', function () {
        return view('private.edit',[
            'user' => Auth::user(),
        ]);
    });

    // Uptade The Data
    Route::put('/uptade' , function (Request $request ) {
        $user = Auth::user();

        // $user->img = $data->img;

        if (strlen($request->full_name) != 0) {
            $user->full_name = $request->full_name;
        }

        if (strlen($request->job_title) != 0) {
            $user->job_title = $request->job_title;
        }

        $user->category = $request->category;
        $user->english_level = $request->english_level;
        $user->country = $request->country;
        $user->skills = json_decode($request->skills);
        $user->bio = $request->bio;
        if ($request->hourly_price != NULL) {
            $user->hourly_price = $request->hourly_price;
        }
        

        // Upload Img From The Request To My Path
        if ($request->hasFile('img')) {
            $file = $request->file('img'); // Get uploaded files

            // $fileName = $file->getClientOriginalName(); // Old way
            if ($file->getClientOriginalExtension() == 'jpg' || $file->getClientOriginalExtension() == 'jpeg') {
                $username = Auth::user()->username; // Get the username of the logged-in user

                // Create the folder
                $folderPath = public_path("profileImgs/$username"); 
                if (!is_dir($folderPath)) {
                    mkdir($folderPath, 0755, true); 
                }
    
                // Move the files
                $fileName = "$username.jpg"; // New way: Use username as filename
                $file->move($folderPath, $fileName);
            
                $user->img = "profileImgs/$username/$fileName";
            } else {
                return redirect()->back()->withErrors(['extenstion' => 'Image Must Be JPG  Extension']);
            }

        }


        
        
        $user->save();

        return redirect('/me');
    });

    // Add Project
    Route::put('/add-project', function (Request $request ) {
        $user = Auth::user();
        $projects = json_decode($user->projects);
        $new_project = [
            'img' => 'project-1.jpg',
            'title' => $request->projectName,
            'url' => $request->url,
        ];
        array_push($projects, $new_project);
        $user->projects = json_encode($projects);
        $user->save();

        return redirect('/me');
    });

    // Remove Project
    Route::put('/remove-project/{title}', function ($title) {

        $user = Auth::user();
        $projects = json_decode($user->projects);
        $new_projects = [];
        foreach ($projects as $project) {
            if ($project->title != $title) {
                array_push($new_projects, $project);
            }
        }
        $user->projects = json_encode($new_projects);
        $user->save();

        return redirect('/me');
    });


    // Add Experience
    Route::put('/add-experience', function (Request $request) {
        $user = Auth::user();
        $experiences = json_decode($user->experiences);
        $new_experience = [
            'title' => $request->title,
            'company' => $request->company,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'bio' => $request->bio,
        ];
        
        array_push($experiences, $new_experience);
        $user->experiences = json_encode($experiences);
        $user->save();

        return redirect('/me');
    });

    // Remove Experience
    Route::put('/remove-experience/{title}', function ($title) {

        $user = Auth::user();
        $experiences = json_decode($user->experiences);
        $new = [];
        foreach ($experiences as $experience) {
            if ($experience->title != $title) {
                array_push($new, $experience);
            }
        }
        $user->experiences = json_encode($new);
        $user->save();

        return redirect('/me');
    });

    // Add Education
    Route::put('/add-education', function (Request $request ,) {
        $user = Auth::user();
        $educations = json_decode($user->educations);
        $new_education = [
            'title' => $request->title,
            'company' => $request->company,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'bio' => $request->bio,
        ];
        array_push($educations, $new_education);
        $user->educations = json_encode($educations);
        $user->save();

        return redirect('/me');
    });

    // Remove Education
    Route::put('/remove-education/{title}', function ($title) {

        $user = Auth::user();
        $educations = json_decode($user->educations);
        $new = []; 
        foreach ($educations as $education) {
            if ($education->title != $title) {
                array_push($new,$education);
            }
        }
        $user->educations = json_encode($new);
        $user->save();

        return redirect('/me');
    });

    // Add And Save Jobs
    Route::get('/add-job',function (Request $request) {

        $user = null;
        if ($request->has('user')) {
            $user = User::find($request->user);
        };

        return view('private.addJob', [
            'user' => $user
        ]);
    });
    
    Route::post('/delete-job' , function () {
        $job = Job::find(request('id'));
        $job->delete();
        return redirect('/me');
    });


    // Delete All Data In Job And Conversation and Notifications Table 
    Route::get('/delete',function () {
        foreach(Job::all() as $job) {
            $job->delete();
        }
        foreach(Notification::all() as $job) {
            $job->delete();
        }
        foreach(Conversation::all() as $job) {
            $job->delete();
        }
        return redirect('/me');
    });

    Route::post('/save-job',function (Request $req) {
        $user = Auth::user();

        $price_min = $req->priceMin;
        $price_max = $req->priceMax;

        // Check If The User Currency Between Min And Max Price

        if ($user->currency < $price_min) {
            return redirect()->back()->withErrors(['balance' => "Your Money Is $user->currency And Must To Be Greater Than $price_min"]);
        } else if ($user->currency < $price_max) {
            return redirect()->back()->withErrors(['balance' => "Your Money Is $user->currency And Must To Be Greater Than $price_max"]);
        }

        // Check If The User Has Not Exceeded The Max Jobs
        if ($user->max_jobs_created > 0 && Job::where('user_id', $user->id)->count() >= $user->max_jobs_created) {
            return redirect()->back()->withErrors(['max_jobs' => 'You Have Reached The Maximum Number Of Jobs']);
        }
        $job = new Job();
        $job->name = $req->project_name;
        $job->bio = $req->bio;
        $job->categories = $req->project_category ;
        $job->skills = $req->skills;
        $job->faq = json_encode(["questions" => $req->questions, 'answers' => $req->answers]);
        $job->english_level = $req->english_level;
        $job->job_type = $req->type;
        $job->freelancer_type ='Agency';
        $job->project_length = $req->project_length;
        $job->radio_price = $req->radio_price;
        $job->price_min = $req->priceMin;
        $job->price_max = $req->priceMax;
        $job->user_id = $user->id;
        $job->user_country = $user->country;
        $job->user_name = $user->full_name;

        if ($req->user) {
            // $req->user Is User Id !
            $job->freelancer = $req->user;
            $job->save();

            // // Create Conversation
            // $conversation = new Conversation();
            // $conversation->project_id = $job->id;
            // $conversation->freelancer_id = $job->freelancer;
            // $conversation->job_owner_id = $user->id;

            // // Create Auto Msg
            // $conversation->messages = json_encode(array(["sender" => $conversation->job_owner_id,
            //  'content' => $job->bio , 'seen' => false , 'created_at' => date_format(date_create(),'h:i A')]));
            // $conversation->save();

            // Create Notification
            $notification = new Notification();
            $notification->sender_id = $job->user_id;
            $notification->receiver_id = $job->freelancer;
            $notification->project_id = $job->id;
            $notification->type = 'new_job_notification';

            // Get User Name
            $freelancerName = User::find($job->freelancer)->full_name;
            $notification->content = "You Are Selected In My Project Lets Discussions Mr <a href='/freelancers/$job->freelancer'>$freelancerName</a> And Propose In <a href='/projects/$job->id'> My Project </a>";

            $notification->save();

            // Update User Currency
            $user->currency -= $req->priceMin;
            $user->save();


            return redirect('/');
        };
        $job->save();
    
        return redirect('/projects' . '/' . $job->id);
    });

    
    Route::get('/inbox-user/{proposal_id}' , function ($proposal_id) {

        $proposal = Proposal::find($proposal_id);

        // Create Messages System

        if (Job::find($proposal->project_id)->user_id == Auth::user()->id) {
            
            // Check if Not Have the same conversestion yet
            $testConv = Conversation::find($proposal->project_id);
            if  (!$testConv) {
            
                $conversation = new Conversation();
                $conversation->project_id = $proposal->project_id;
                $conversation->freelancer_id = $proposal->freelancer_id;
                $conversation->job_owner_id = Auth::user()->id;
    
                // Create Msg
                $conversation->messages = json_encode(array(["sender" => $conversation->freelancer_id,
                'content' => $proposal->description , 'seen' => false , 'created_at' => date_format(date_create(),'h:i A')]));
    
                $conversation->save();
            } else {
                return redirect("/inbox?conv=$testConv->id");
            }

            
            return redirect('/inbox');
        } else {
            return redirect()->back()->withErrors(['Don"t Try To Hack 😂']);
        }

    });



    // Inbox Page
    Route::get('/inbox', function () {
        $user = Auth::user();
        $conversations = Conversation::where('freelancer_id',$user->id)
        ->orWhere('job_owner_id',$user->id)
        ->orderBy('updated_at','desc')->get();

        // Specific Page
        if (request()->has('conv')) {
            // Get The Unreaded And Make It Readed
            $conversation = $conversations->find(request()->input('conv')) ;
            $newMsgs = json_decode($conversation->messages);
            // Loop To Rewrite It
            foreach ($newMsgs as $object) {
                if ($object->sender != Auth::user()->id) {
                    $object->seen = true;
                }
            }  
            $conversation->messages = json_encode($newMsgs);
            $conversation->save();

            return view('private.inbox', [
                'conversation' => $conversation,
                'conversations' => $conversations,
            ]);

        }



        return view('private.inbox', [
            'conversations' => $conversations,
        ]);
    });

    // Send Message
    Route::post('/send-message', function (Request $request) {
        $user = Auth::user();

        $conversation = Conversation::find($request->mc);
        $all_msgs = json_decode($conversation->messages);
        array_push($all_msgs,["sender" => $user->id, 'content' => $request->msg , "seen" => false, 'created_at' => date_format(date_create(),'h:i A')]);
        $conversation->messages = json_encode($all_msgs);
        
        $conversation->save();

        return redirect()->back()->with('success', 'Message sent successfully!');

        // $user = Auth::user();

        // $conversation = Conversation::find($request->mc);
        // $all_msgs = json_decode($conversation->messages);
        // $new_msg = ["sender" => $user->id, 'content' => $request->msg, "seen" => false, 'created_at' => date_format(date_create(), 'h:i A')];
        // array_push($all_msgs, $new_msg);
        // $conversation->messages = json_encode($all_msgs);

        // $conversation->save();

        
        // broadcast(new MessageSent($new_msg))->toOthers();

        // return response()->json(['status' => 'Message sent successfully!']);

    });


    // Acept Proposal
    Route::get('/accept-proposal/{proposal_id}',function ($proposal_id) {
        $proposal = Proposal::find($proposal_id);
        $job = Job::find($proposal->project_id);
        $freelancer = User::find($proposal->freelancer_id);


        if (Auth::user()->id == $job->user_id) {
            $proposal->status = 'accepted';
            $proposal->save();
    
            $job->freelancer = $proposal->freelancer_id;
            $job->save();


            $freelancer->on_projects++;
            $freelancer->save();

            // Save Notification
            $notification = new Notification();
            $notification->sender_id = $job->user_id;
            $notification->receiver_id = $proposal->freelancer_id;
            $notification->project_id = $job->id;
            $notification->type = 'proposal_accepted_notification';

            // Get User Name
            $notification->content = "Your Proposal Has Been Accepted In <a href='/projects/$job->id'> $job->name </a> By <a href='/freelancers/$job->user_id'>$job->user_name</a>";

            $notification->save();

            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('You Must Be Project Owner !');
        }
    });

    // Cancel Proposal
    Route::get('/cancel-proposal/{proposal_id}',function ($proposal_id) {
        $proposal = Proposal::find($proposal_id);
        $job = Job::find($proposal->project_id);
        $freelancer = User::find($proposal->freelancer_id);
        if (Auth::user()->id == $job->user_id) {
            $proposal->status = 'failed';
            $proposal->save();
    
            $job->freelancer = null;
            $job->save();

            $freelancer->on_projects--;
            $freelancer->cancelled_projects++;
            $freelancer->save();

            // Save Notification
            $notification = new Notification();
            $notification->sender_id = $job->user_id;
            $notification->receiver_id = $proposal->freelancer_id;
            $notification->project_id = $job->id;
            $notification->type = 'proposal_rejected_notification';

            // Get User Name
            $notification->content = "The Project Has Been Rejected ( <a href='/projects/$job->id'> $job->name </a> ) By <a href='/freelancers/$job->user_id'>$job->user_name</a>";

            $notification->save();

            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('You Must Be Project Owner !');
        }
    });
    // Reject Proposal
    Route::get('/reject-proposal/{proposal_id}', function ($proposal_id) {
        $proposal = Proposal::find($proposal_id);
        $job = Job::find($proposal->project_id);
        if (Auth::user()->id == $job->user_id) {
            $proposal->status = 'failed';
            $proposal->save();


            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('You Must Be Project Owner !');
        }
    });


    // Recive Project
    Route::get('/rate-project/{proposal_id}', function ($proposal_id) {
        $proposal = Proposal::find($proposal_id);
        $job = Job::find($proposal->project_id);

        $owner = Auth::user();

        if ($owner->id == $job->user_id) {
            // return redirect()->back();
            return view('private.rate' , [
                'projectId' => $job->id,
                'proposalId' => $proposal_id, 
            ]);
        } else {
            return redirect()->back()->withErrors('You Must Be Project Owner !');
        }
    });

    Route::post('/recive-project' , function () {
        $data = request();

        // Declare Data
        $proposal = Proposal::find($data->pi);
        $job = Job::find($data->ji);
        $freelancer = User::find($proposal->freelancer_id);
        $owner = Auth::user();

        if ($owner->id == $job->user_id) {
            

        
            $minus_money = $proposal->hour_rate * 10 / 100;
            $freelancer->total_earning += $proposal->hour_rate - $minus_money;
            $freelancer->currency += $proposal->hour_rate - $minus_money;
            $freelancer->completed_projectes++;


            if  ($freelancer->on_projects > 0) { 
                $freelancer->on_projects--;
            }
            

            // Add Freelancer Feedback
            $freelancer_stars = $freelancer->stars;
            if ($freelancer_stars == 0) {
                $freelancer->stars = $data->stars;
            } else {
                // Equation For Calculate Stars
                $freelancer_stars = ($freelancer_stars + $data->stars) / 2;

                $freelancer->stars = $data->stars;
            }

            if ($data->feedback != '') {
                $freelancer_feedbacks = json_decode($freelancer->feedbacks,true);
                $freelancer_feedbacks[] = [ "content"  => $data->feedback ,  'user_id' => $owner->id, 'stars' => $data->stars , 'created_at' => now() ];
                $freelancer->feedbacks = json_encode($freelancer_feedbacks);
            }


            $job->status = 'completed';
            
            $job->save();
            $owner->save();
            $freelancer->save();
            


            // Notification
            $notification = new Notification();
            $notification->sender_id = $owner->id;
            $notification->receiver_id = $freelancer->id;
            $notification->project_id = $job->id;
            $notification->type = 'project_completed';
            $notification->content = "Your Project Is Completed! You Total Earning Now Is <a> $freelancer->total_earning </a> From  <a href='/freelancers/$owner->id'> $owner->full_name <a> ! Keep Completed";
            $notification->save();


            return redirect('/inbox');
        } else {
            return redirect()->back()->withErrors('You Must Be Project Owner !');
        }
    });



    // Money !

    Route::post('/send-money', function ()  {
        // Send The Money From Paypal

        // Paypal Code

        // Add Money To User
        $user = Auth::user();
        $user->currency += request('accurancy_of_money');
        $user->save();

        // Notification Code

        return redirect()->back();
        
    });

    Route::post('/recive-money' , function () {

        // Recive The Money To Paypal
        $papyal_email = request('email_for_user');
        $accurancy = request('accurancy_of_money');


        // Paypal Code
        // ...

        // Minus Money From User
        $user = Auth::user();
        $user->currency -= $accurancy;
        $user->save();

        // Notification Code

        return redirect()->back();

    });

});




# Login Routes

// Log in
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/login', function() {
    return redirect('/')->withErrors('You Must Log In');
});

// Sign Up
Route::post('/join', [RegisterController::class, 'joinUs']);
Route::post('/add-password', [RegisterController::class, 'addPassword']);
Route::post('/save', [RegisterController::class, 'save']);
    
// Sign out
Route::post('/signOut',function ( Request $request) {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();
    
    return redirect('/');
});


// Link Personl-Freelancer-Page By Database

Route::get('/freelancers/{name}', function ($name) {
    $freelancer = User::where('username', $name)->first();
    if (!$freelancer) {
        $freelancer = User::where('id',$name)->first();
    }
    if ($freelancer) {
        if (Auth::check()) {
            if ($name == Auth::user()->id) {
                return redirect('/me');
            }
        }  
        return view('personal-freelancer', [
            'freelancer' => $freelancer,
            'not_found' => FALSE,
        ]);
    } else {
        return view('404', [
            'error' => "Sorry Not Found This :(   Check The User Name Of Freelancer !",
        ]);
    }
});




Route::get('/jobs', function (Request $request) {
    $jobs = Job::all();
    // Store filter data in the session
    session()->put('radio-price', $request->input('radio-price'));
    session()->put('price', $request->input('price'));
    session()->put('priceMin', $request->input('priceMin'));
    session()->put('priceMax', $request->input('priceMax'));
    session()->put('english-level', $request->input('english-level', []));
    session()->put('type', $request->input('type', []));
    session()->put('freelancer-type', $request->input('freelancer-type', []));
    session()->put('project-length', $request->input('project-length', []));


    // Get the filter values from the request
    $category = $request->input('category', []); // Get as an array
    $keyword = $request->input('keyword','');
    $skills = $request->input('skills', []); // Get as an array
    $englishLevel = $request->input('english-level', []); // Get as an array
    $jobType = $request->input('type', []); // Get as an array
    $freelancerType = $request->input('freelancer-type', []); // Get as an array
    $projectLength = $request->input('project-length', []); // Get as an array
    $radioPrice = $request->input('radio-price');
    $priceMin = $request->input('priceMin');
    $priceMax = $request->input('priceMax');

    // Start with an empty query
    $jobs = Job::query();

    // Filter by category (at least one match)
    if (!empty($category)) {
        $jobs->where(function ($query) use ($category) {
            foreach ($category as $cat) {
                $query->orWhere('categories', 'like', "%$cat%");
            }
        });
    }
    // Filter by keyword
    if (!empty($keyword)) {
        $jobs->where('name', 'like', "%$keyword%");
    }

    // Filter by skills (at least one match)
    if (!empty($skills)) {
        $jobs->where(function ($query) use ($skills) {
            foreach ($skills as $skill) {
                $query->orWhere('skills', 'like', "%$skill%");
            }
        });
    }

    // Filter by English level (at least one match)
    if (!empty($englishLevel)) {
        $jobs->where(function ($query) use ($englishLevel) {
            foreach ($englishLevel as $level) {
                $query->orWhere('english_level', $level);
            }
        });
    }

    // Filter by job type (at least one match)
    if (!empty($jobType)) {
        $jobs->where(function ($query) use ($jobType) {
            foreach ($jobType as $type) {
                $query->orWhere('job_type', $type);
            }
        });
    }

    // Filter by freelancer type (at least one match)
    if (!empty($freelancerType)) {
        $jobs->where(function ($query) use ($freelancerType) {
            foreach ($freelancerType as $type) {
                $query->orWhere('freelancer_type', $type);
            }
        });
    }

    // Filter by project length (at least one match)
    if (!empty($projectLength)) {
        $jobs->where(function ($query) use ($projectLength) {
            foreach ($projectLength as $length) {
                $query->orWhere('project_length', $length);
            }
        });
    }

    // Get the filtered jobs (excluding price)
    $filteredJobs = $jobs->get();

    // Filter by price (after other conditions)
    $filteredJobs = $filteredJobs->filter(function ($job) use ($radioPrice, $priceMin, $priceMax) {
        if ($radioPrice === 'fixed') {
            return $job->radio_price === 'fixed';
        } else if ($radioPrice === 'hourly') {
            return $job->radio_price === 'hourly';
        }

        if ($priceMin) {
            return $job->price_min >= $priceMin;
        }

        if ($priceMax) {
            return $job->price_max <= $priceMax;
        }

        return true; // If no price filters are applied, include all jobs
    });

    // Pass the filtered jobs to the view
    return view('jobs', [
        'jobs' => json_encode($filteredJobs),
        'category' => $category,
    ]);
});

Route::post('/jobs',function (Request $request) {
    // Get the filter values from the request
    $category = request()->input('category');
    $skills = request()->input('skills');
    $englishLevel = request()->input('english-level');
    $jobType = request()->input('type');
    $freelancerType = request()->input('freelancer-type');
    $projectLength = request()->input('project-length');
    $radioPrice = request()->input('radio-price');
    $priceMin = request()->input('priceMin');
    $priceMax = request()->input('priceMax');

    // Start with an empty query
    $jobs = Job::all();

    // Filter by category
    if ($category) {
        $jobs->where('categories', 'like', "%$category%");
    }

    // Filter by skills
    if ($skills) {
        $jobs->whereJsonContains('skills', $skills);
    }

    // Filter by English level
    if ($englishLevel) {
        $jobs->where('english_level', $englishLevel);
    }

    // Filter by job type
    if ($jobType) {
        $jobs->where('job_type', $jobType);
    }

    // Filter by freelancer type
    if ($freelancerType) {
        $jobs->where('freelancer_type', $freelancerType);
    }

    // Filter by project length
    if ($projectLength) {
        $jobs->where('project_length', $projectLength);
    }

    // Filter by price
    if ($radioPrice === 'fixed') {
        $jobs->where('radio_price', 'fixed');
    } else if ($radioPrice === 'hourly') {
        $jobs->where('radio_price', 'hourly');
    }

    if ($priceMin) {
        $jobs->where('price_min', '>=', $priceMin);
    }

    if ($priceMax) {
        $jobs->where('price_max', '<=', $priceMax);
    }

    // Get the filtered jobs
    // $filteredJobs = $jobs->get();

    // Pass the filtered jobs to the view
    return view('jobs', [
        'jobs' => json_encode($jobs),
        'category' => $category,
    ]);

});

// Main Pages
Route::get('/', function () {

    if (Auth::check()) {
        return redirect('/me');
    }

    // I Want To Filter The Top Freelancers
    $topFreelancers = User::where('type', 'freelancer')
    ->orderByRaw('(JSON_EXTRACT(feedbacks, "$[*]")) DESC')
    ->take(4)
    ->get();
    return view('welcome', [
        'topFreelancers' => $topFreelancers,
    ]);
    
})->name('welcome');

Route::get('/about', function () {
    return view('about');
});



// All Freelancer
Route::get('/freelancers', function (Request $request) {
    $freelancers = User::where('type', 'freelancer')->get();
    
    
    // Calculate Every Category Members count

    $businessCount = 0;

    // digital-marketing
    $digitalMarketingCount = 0;

    $musicAudioCount = 0;

    $programmingTechCount = 0;

    $videoAnimationCount = 0;

    $writingTranslationCount = 0;

    $graphicDesignerCount = 0;

    foreach ($freelancers as $freelancer) {
        // Increament Varbiles
        if ($freelancer->category == 'business') {
            $businessCount++;
        } elseif ($freelancer->category == 'digital-marketing') {
            $digitalMarketingCount++;
        } elseif ($freelancer->category == 'music-&-audio') {
            $musicAudioCount++;
        } elseif ($freelancer->category == 'programming-&-tech') {
            $programmingTechCount++;
        } elseif ($freelancer->category == 'video-&-animation') {
            $videoAnimationCount++;
        } elseif ($freelancer->category == 'writing-&-translation') {
            $writingTranslationCount++;
        } elseif ($freelancer->category == 'graphic-designer') {
            $graphicDesignerCount++;
        }
    }

    
    // Filter By Freelancer Name
    if ($request->has('keyword')) {
        $freelancers->where('full_name', 'like', '%' . $request->input('keyword') . '%');
    }

    // Filter By Catefory
    if ($request->has('category')) {
        // return $request->input('category');
        $freelancers->where('category',$request->input('category'));
    }
    // Filter by freelancer type
    if ($request->has('freelancer-type')) {
        $freelancers->where('freelancer_type', $request->input('freelancer-type'));
    }
    // Filter by Industrial
    if ($request->has('industrial')) {
        $freelancers->where('industrial', $request->input('industrial'));
    }
    // Filter by Specialization
    if ($request->has('specialization')) {
        $freelancers->where('specialization', $request->input('specialization'));
    }
    // Filter by skills (at least one match)
    $skills = $request->input('skills');

    if (!empty($skills)) {
        $freelancers->where(function ($query) use ($skills) {
            foreach ($skills as $skill) {
                $query->orWhere('skills', 'like', "%$skill%");
            }
        });
    }
    // Filter by English level
    if ($request->has('english-level')) {
        $freelancers->where('english_level', $request->input('english-level'));
    }
    // Filter by Job Type
    if ($request->has('job-type')) {
        $freelancers->where('job_type', $request->input('job-type'));
    }
    // Filter by Project-length
    if ($request->has('project-length')) {
        $freelancers->where('project_length', $request->input('project-length'));
    }



    return view('freelancers', [
        'freelancers' => $freelancers,
        'categoriesCount' => ['design' => $graphicDesignerCount , 'bus' => $businessCount , 'marketing' => $digitalMarketingCount , 'music' => $musicAudioCount , 'code' => $programmingTechCount , 'video' => $videoAnimationCount , 'write' => $writingTranslationCount]
    ]);
});

Route::get('/how', function () {
    return view('how');
});
Route::get('/projects/{id}', function ($id) {
    return view('projectDetail',
    [
        'project' => Job::find($id),
        'proposals' => Proposal::where('project_id', $id)->get(),
    ]);
});
Route::post('/save-proposal-to/{id}', function ($id) {
    $project = Job::find($id);

    // Check if the user write proposal before
    $proposal = Proposal::where('freelancer_id', auth()->user()->id)
    ->where('project_id', $project->id)
    ->first();


    if ($proposal) {
        return redirect("/proposals/$project->id");
    }


    // Save proposal

    $proposal = new Proposal();
    $proposal->status = false;
    $proposal->project_id = $project->id;
    $proposal->freelancer_id = Auth::user()->id;
    $proposal->description = request()->input('description');
    $proposal->hour_rate = request()->input('hour_rate');
    $proposal->hours = request()->input('hours');
    $proposal->save();
    return redirect('/proposals' . '/' . $project->id);
});


Route::get('/feedbacks/{id}' ,function($id) {
    return view('feedback', [
        'user' => User::find($id),
    ]);
});



Route::get('/services' , function () {
    return view('soon');
});



// Proposals
Route::get('/proposals/{id}', function ($id) {
    return view('proposals', [
        'project' => Job::find($id),
        'proposals' => Proposal::where('project_id', $id)->get(),
    ]);
});



// Password Reset Routes
Route::get('/forgetPassword' , function () {
    return view('auth.forget-password' , [
        'msg' => ''
    ]);
});


Route::post('/forgetPassword' , function () {
    $email = request('email');
    $user = User::where('email' , $email)->first();
    if ($user) { 
        $user->token = Str::random(60);
        $user->save();
        $url = url("/forget-password/$user->token");
        Mail::to($email)->send(new passwordReset($url));
        return view('auth.forget-password' , [
            'msg' => 'Check your email to reset password'
        ]);
    } else {
        return view('auth.forget-password' , [
            'msg' => 'Email Not Found'
        ]);
    }
});
Route::get('/forget-password/{token}' , function ($token) {
    $user = User::where('token' , $token)->first();
    if ($user) {
        return view('auth.reset-password' , ['user' => $user , 'msg' => '' , 'userToken' => $token]);
    } else {
        return view('auth.forget-password' , [
            'msg' => 'Invalid Token'
        ]);
    }
});



Route::post('/forget-password' , function () {
    $token = request('userToken');
    $user = User::where('token' , $token)->first();
    if ($user) {
        // Validate Passwrod
        request()->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);
        
        $user->password = bcrypt(request('password'));
        $user->token = null;
        $user->save();
        return view('welcome' , [
            'msg' => 'Password Changed Successfully'
        ]);
    } else {
        return view('auth.forget-password' , [
            'msg' => 'Invalid Token'
        ]);
    }
});