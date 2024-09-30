<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{ 
    
  

    
    
    public function login() {
        return view("user.login");
    }
    public function register() {
        return view("user.register");
    }
    
    
    public function profileedit()
    {
        // Fetch the logged-in user's information
        $LoggedUserInfo = User::find(session('LoggedUserInfo'));
    
        if (!$LoggedUserInfo) {
            return redirect('user/login')->with('fail', 'You must be logged in to access your profile.');
        }
    
        $userId = session('LoggedUserInfo');
        $LoggedUserInfo = User::find($userId);
    
        if (!$LoggedUserInfo) {
            return redirect('user/login')->with('fail', 'You must be logged in to access the dashboard');
        }
        $totalLikesCount = Like::whereIn('question_id', function ($query) use ($userId) {
            $query->select('id')
                  ->from('questions')
                  ->where('user_id', $userId);
        })->count();
    
        // Fetch the total product likes count
     
        // Fetch all likes related to the user
        $likes = Like::whereIn('question_id', function ($query) use ($userId) {
            $query->select('id')
                  ->from('questions')
                  ->where('user_id', $userId);
        })->with('user')->orderBy('created_at', 'desc')->get();
    
        // Fetch all replies related to the user, ordered by latest first
        $replies = Reply::whereIn('question_id', function ($query) use ($userId) {
            $query->select('id')
                  ->from('questions')
                  ->where('user_id', $userId);
        })->with('user')->orderBy('created_at', 'desc')->get();
        // Pass the logged-in user's information to the view
        return view('user.profileedit', ['LoggedUserInfo' => $LoggedUserInfo
    ,  'totalLikesCount' => $totalLikesCount,
    'likes' => $likes,
   'replies' => $replies
    ]);
    }
    
     
     
    public function profileview()
    {
        // Fetch the logged-in user's information
        $LoggedUserInfo = User::find(session('LoggedUserInfo'));
    
        if (!$LoggedUserInfo) {
            return redirect('user/login')->with('fail', 'You must be logged in to access your profile.');
        }
        $userId = session('LoggedUserInfo');
        $LoggedUserInfo = User::find($userId);
    
        if (!$LoggedUserInfo) {
            return redirect('user/login')->with('fail', 'You must be logged in to access the dashboard');
        }
        $totalLikesCount = Like::whereIn('question_id', function ($query) use ($userId) {
            $query->select('id')
                  ->from('questions')
                  ->where('user_id', $userId);
        })->count();
    
        // Fetch the total product likes count
     
        // Fetch all likes related to the user
        $likes = Like::whereIn('question_id', function ($query) use ($userId) {
            $query->select('id')
                  ->from('questions')
                  ->where('user_id', $userId);
        })->with('user')->orderBy('created_at', 'desc')->get();
    
        // Fetch all replies related to the user, ordered by latest first
        $replies = Reply::whereIn('question_id', function ($query) use ($userId) {
            $query->select('id')
                  ->from('questions')
                  ->where('user_id', $userId);
        })->with('user')->orderBy('created_at', 'desc')->get();
        // Pass the logged-in user's information to the view
        return view('user.profileview', ['LoggedUserInfo' => $LoggedUserInfo,
         'totalLikesCount' => $totalLikesCount,
         'likes' => $likes,
        'replies' => $replies]);
    }
    
   
    
    public function dashboard()
{
    $userId = session('LoggedUserInfo');
    $LoggedUserInfo = User::find($userId);

    if (!$LoggedUserInfo) {
        return redirect('user/login')->with('fail', 'You must be logged in to access the dashboard');
    }

     

    return view('user.dashboard', [
        'LoggedUserInfo' => $LoggedUserInfo,
        
    ]);
}

    
 
    
    
    // SearchController.php
     

    public function home(Request $request)
    {
        // Retrieve the logged-in user info
        $userId = $request->session()->get('LoggedUserInfo');
        $user = User::find($userId); // Fetch user details from the database if needed

        return view('home', compact('user')); // Pass user info to the view
    }
    public function check(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);
    
        // Check if the user exists
        $userInfo = User::where('email', $request->email)->first();
    
        if (!$userInfo) {
            return back()->withInput()->withErrors(['email' => 'Email not found']);
        }
        
        // Check if the user's account is inactive
        if ($userInfo->status === 'inactive') {
            return back()->withInput()->withErrors(['status' => 'Your account is inactive']);
        }
    
        // Verify the user's password
        if (!Hash::check($request->password, $userInfo->password)) {
            return back()->withInput()->withErrors(['password' => 'Incorrect password']);
        }
    
        // If everything is fine, set the session variables
        session([
            'LoggedUserInfo' => $userInfo->id,
            'LoggedUserName' => $userInfo->name,
        ]);
    
        // Check if the user is already logged in
        if (session('LoggedUserInfo')) {
            return redirect()->route('user.dashboard'); // Redirect to dashboard if already logged in
        }
    
        return redirect()->route('home');
    }
    

    

    public function logout()
    {
         if (session()->has('LoggedUserInfo')) {
             session()->forget('LoggedUserInfo');
        }
        session()->flush();

         return redirect()->route('home');
    }
    
 
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|regex:/^\S*$/',
            'confirm_password' => 'required|string|same:password',
        ], [
            'email.unique' => 'This email is already registered.',
            'password.min' => 'Password must be at least 8 characters long.',
            'confirm_password.same' => 'The confirm password must match the password.',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('user.login')->with('success', 'User created successfully!');
    }
    

     
    public function profile()
    {
        
        $LoggedUserInfo = User::find(session('LoggedUserInfo'));
        if (!$LoggedUserInfo) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
        }
    
          return view('user.profile', ['LoggedUserInfo' => $LoggedUserInfo]);
    }
 
    public function updateProfile(Request $request)
    {
        // Fetch the logged-in user's information
        $loggedUser = User::find(session('LoggedUserInfo')); // Ensure the session key is correct
        
        if (!$loggedUser) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the profile.');
        }
        
        // Validate the incoming request data
        $request->validate([
            'name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'nullable|string|max:20',
        ]);
    
        // Update the user's profile with the validated data
        $loggedUser->name = $request->input('name');
        $loggedUser->username = $request->input('username');
        $loggedUser->bio = $request->input('bio');
        $loggedUser->phone_number = $request->input('phone_number');
    
        // Handle the profile picture upload if a file is provided
        if ($request->hasFile('picture')) {
            $pictureFile = $request->file('picture');
            $picturePath = $pictureFile->store('public/downloads');
            $loggedUser->picture = str_replace('public/', '', $picturePath);
        }
    
        // Save the updated profile
        $loggedUser->save();
    
        // Redirect to the user's profile view with a success message
        return redirect()->route('user.profileview')->with('success', 'Profile updated successfully');
    }
    
}