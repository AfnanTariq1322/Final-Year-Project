<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Blog;

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
    
        // Fetch user details from the database
        $user = User::find($userId);
        
        $users = User::take(8)->get(); // or User::limit(8)->get();
       
        // Pass user info and LoggedUserInfo to the view
        return view('home', [
            'user' => $user, 
            'users' => $users, 

            'LoggedUserInfo' => $user // Pass the entire user object
        ]);
    }
    public function blogs(Request $request)
    {
        // Retrieve the logged-in user info
        $userId = $request->session()->get('LoggedUserInfo');
        
        // Fetch user details from the database
        $user = User::find($userId);
        
        // Fetch categories for the dropdown
        $categories = Category::all(); // Assuming you have a Category model
        
        // Initialize the query for blogs
        $query = Blog::query();
        
        // Filter by selected category
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        
        // Filter by blog title
        if ($request->has('blog_title') && $request->blog_title != '') {
            $query->where('title', 'like', '%' . $request->blog_title . '%');
        }
        
        // Fetch filtered blogs with pagination
        // Append query parameters to the pagination links
        $blogs = $query->paginate(9)->appends($request->all()); 
        
        // Pass user info, categories, and filtered blogs to the view
        return view('blogs', [
            'user' => $user,
            'categories' => $categories,
            'blogs' => $blogs,
            'LoggedUserInfo' => $user
        ]);
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
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the dashboard');
        }
    
          return view('user.profile', ['LoggedUserInfo' => $LoggedUserInfo]);
    }
 
    public function updateProfile(Request $request)
    {
        // Fetch the logged-in user's information using the correct session key
        $loggedUser = User::find(session('LoggedUserInfo'));
    
        // Check if the user is logged in
        if (!$loggedUser) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the profile.');
        }
    
        // Validate the incoming request data
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',  // Disabled in form, but validate if present
            'bloodgroup' => 'nullable|string|max:10',
            'bloodpressure' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Handle profile image upload
        ]);
    
        // Update the user's profile with validated data
        $loggedUser->name = $request->input('name');
        $loggedUser->bloodgroup = $request->input('bloodgroup');
        $loggedUser->bloodpressure = $request->input('bloodpressure');
        $loggedUser->phone = $request->input('phone');
        $loggedUser->country = $request->input('country');
        $loggedUser->city = $request->input('city');
        $loggedUser->address = $request->input('address');
    
        // Handle the profile image upload if a file is provided
        if ($request->hasFile('image')) {
            // Store the uploaded image in 'public/profile' folder
            $imageFile = $request->file('image');
            $imagePath = $imageFile->store('public/profile');
            // Store the relative path (without 'public/') in the database
            $loggedUser->image = str_replace('public/', '', $imagePath);
        }
    
        // Save the updated user profile
        $loggedUser->save();
    
        // Redirect to the user's profile view with a success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    

    
}