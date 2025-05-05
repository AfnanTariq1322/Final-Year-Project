<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\Appointment;
use PDF;

class UsersController extends Controller
{
    public function filterBlogsByCategory(Request $request, $category_id)
    {
        // Retrieve categories for the dropdown
        $categories = Category::all();
    
        // Find the category by ID
        $category = Category::find($category_id);
    
        // Initialize the query for blogs
        $query = Blog::query();
    
        // If category exists, apply category filter
        if ($category) {
            $query->where('category_id', $category->id);
        }
    
        // If a blog title is provided, filter by blog title
        if ($request->has('blog_title') && $request->blog_title != '') {
            $query->where('title', 'like', '%' . $request->blog_title . '%');
        }
    
        // Fetch filtered blogs with pagination
        $blogs = $query->paginate(9)->appends($request->all());
    
        // Pass the category, filtered blogs, and categories to the view
        return view('blogs', compact('blogs', 'categories'));
    }

    public function showBlog($id, Request $request)
    {
        // Get the blog by ID and eager load its comments
        $blog = Blog::with('comments.user')->findOrFail($id); // Ensure you load comments and user relationships
        $blog->increment('views'); // This will increment the 'views' column by 1
    
        // Fetch all categories
        $categories = Category::all();
    
        // Retrieve the logged-in user's information
        $userId = $request->session()->get('LoggedUserInfo');
        $user = User::find($userId);
        
        // Get the top 4 most popular blogs (most comments and views)
        $popularBlogs = Blog::withCount('comments') // Count the number of comments for each blog
                            ->orderByDesc('views') // Order by views
                            ->orderByDesc('comments_count') // Then order by the number of comments
                            ->take(4) // Take the top 4
                            ->get();
    
        // Return the blog, categories, popular blogs, and logged user information to the view
        return view('blogdetail', [
            'blog' => $blog,
            'categories' => $categories,
            'LoggedUserInfo' => $user,
            'user' => $user,
            'popularBlogs' => $popularBlogs // Pass the popular blogs to the view
        ]);
    }
    
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

    public function diagnosis(Request $request)
    {
        // Retrieve the logged-in user info
        $userId = $request->session()->get('LoggedUserInfo');

        // Fetch user details from the database
        $user = User::find($userId);
        
        $users = User::take(8)->get(); // or User::limit(8)->get();
      
        // Pass user info and LoggedUserInfo to the view
        return view('diagnosis', [
            'user' => $user, 
            'users' => $users, 

            'LoggedUserInfo' => $user // Pass the entire user object
        ]);
    }

    public function contact(Request $request)
    {
        // Retrieve the logged-in user info
        $userId = $request->session()->get('LoggedUserInfo');

        // Fetch user details from the database
        $user = User::find($userId);
        
        $users = User::take(8)->get(); // or User::limit(8)->get();
      
        // Pass user info and LoggedUserInfo to the view
        return view('contact', [
            'user' => $user, 
            'users' => $users, 

            'LoggedUserInfo' => $user // Pass the entire user object
        ]);
    }

    public function about(Request $request)
    {
        // Retrieve the logged-in user info
        $userId = $request->session()->get('LoggedUserInfo');

        // Fetch user details from the database
        $user = User::find($userId);
        
        $users = User::take(8)->get(); // or User::limit(8)->get();
      
        // Pass user info and LoggedUserInfo to the view
        return view('about', [
            'user' => $user, 
            'users' => $users, 

            'LoggedUserInfo' => $user // Pass the entire user object
        ]);
    }

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

        // Get total appointments for the user
        $totalAppointments = Appointment::where('user_id', $userId)->count();

        // Get latest disease prediction
        $latestPrediction = null;
        $fundusImagesCount = 0;
        $acuteCasesCount = 0;

        if ($LoggedUserInfo->acute_disease_detected) {
            // Handle both string and array cases
            $diseaseData = is_string($LoggedUserInfo->acute_disease_detected) 
                ? json_decode($LoggedUserInfo->acute_disease_detected, true) 
                : $LoggedUserInfo->acute_disease_detected;

            if ($diseaseData && isset($diseaseData['predicted_class'])) {
                $latestPrediction = $diseaseData['predicted_class'];
                $fundusImagesCount = 1; // Since we're storing the latest analysis

                // Check for acute cases (confidence > 0.7)
                if (isset($diseaseData['confidence']) && $diseaseData['confidence'] > 0.7) {
                    $acuteCasesCount = 1;
                }
            }
        }

        return view('user.dashboard', [
            'LoggedUserInfo' => $LoggedUserInfo,
            'totalAppointments' => $totalAppointments,
            'latestPrediction' => $latestPrediction,
            'fundusImagesCount' => $fundusImagesCount,
            'acuteCasesCount' => $acuteCasesCount
        ]);
    }

    
 
    // SearchController.php

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
        
        // Order blogs by 'created_at' in descending order to get the latest blog first
        $blogs = $query->orderBy('created_at', 'desc')->paginate(9)->appends($request->all()); 
        
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
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);

        // Find user by email
        $userInfo = User::where('email', $request->email)->first();

        if (!$userInfo) {
            return response()->json(['success' => false, 'error' => 'Email not found.']);
        }
     
        // Verify password
        if (!Hash::check($request->password, $userInfo->password)) {
            return response()->json(['success' => false, 'error' => 'Incorrect password.']);
        }

        // ✅ Check if the email is verified
        if (!$userInfo->is_verified) {
            return response()->json([
                'success' => false,
                'otp_required' => true,  // Indicates OTP verification is needed
                'email' => $request->email
            ]);
        }

       // ✅ Check if user status is inactive
       if ($userInfo->status === 'inactive') {
        return response()->json([
            'success' => false,
            'error' => 'Your account is currently inactive. Please wait for admin approval.'
        ]);
    }
        // Set session variables
        session([
            'LoggedUserInfo' => $userInfo->id,
            'LoggedUserName' => $userInfo->name,
        ]);

        return response()->json(['success' => true, 'redirect' => route('user.dashboard')]);
    }

    public function doctorlogin()
    {
        return view('doctor.login');
    }
    

    public function logout()
    {
         if (session()->has('LoggedUserInfo')) {
             session()->forget('LoggedUserInfo');
        }
        session()->flush();

         return redirect()->route('home');
    }

    
    private function sendResetEmailViaBrevo($email, $name, $resetLink)
     {
        $apiKey = "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";

        $data = [
            "sender" => [
                "name" => "Fundus Image Analysis",
                "email" => "afnantariq715@gmail.com" // Must be a verified sender in Brevo
            ],
            "to" => [
                [
                    "name" => $name,
                    "email" => $email
                ]
            ],
            "subject" => "Reset Your Password",
            "htmlContent" => "<html><body><h1>Password Reset</h1>
                              <p>Click the link below to reset your password:</p>
                              <p><a href='{$resetLink}'>Reset Password</a></p>
                              <p>If you didn't request a password reset, ignore this email.</p>
                              </body></html>"
        ];

        $jsonData = json_encode($data);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error("JSON Encode Error: " . json_last_error_msg());
            return;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.brevo.com/v3/smtp/email");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "accept: application/json",
            "api-key: $apiKey",
            "content-type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            Log::error("cURL Error: " . $curlError);
        } else {
            Log::info("Brevo Email Response: " . $response);
        }
    }

    private function sendEmailViaBrevo($email, $name, $otp)
    {
    $apiKey = "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";

        $data = [
            "sender" => [
                "name" => "Fundus Image Analysis",
                "email" => "afnantariq715@gmail.com" // Must be a verified sender in Brevo
            ],
            "to" => [
                [
                    "name" => $name,
                    "email" => $email
                ]
            ],
            "subject" => "Verify Your Email",
            "htmlContent" => "<html><body><h1>Email Verification</h1><p>Your OTP is: <strong>{$otp}</strong></p><p>It is valid for 10 minutes.</p></body></html>"
        ];

        $jsonData = json_encode($data);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error("JSON Encode Error: " . json_last_error_msg());
            return;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.brevo.com/v3/smtp/email");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "accept: application/json",
            "api-key: $apiKey",
            "content-type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            Log::error("cURL Error: " . $curlError);
        } else {
            Log::info("Brevo Email Response: " . $response);
        }
    }

    public function save(Request $request)
    {
        // Validate user input
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|regex:/^\S*$/',
            'confirm_password' => 'required|string|same:password',
        ], [
            'email.unique' => 'This email is already registered.',
            'password.min' => 'Password must be at least 8 characters long.',
            'confirm_password.same' => 'The confirm password must match the password.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        // Generate OTP
        $otp = rand(100000, 999999);
        $otpExpiresAt = now()->addMinutes(10);

        // Create user record
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp_code' => $otp,
            'otp_expires_at' => $otpExpiresAt,
            'is_verified' => false,
        ]);

        // Send OTP via Brevo API
        $this->sendEmailViaBrevo($request->email, $request->name, $otp);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful. Please verify your OTP.'
        ]);
    }

    /**
     * Send email via Brevo API
     */

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp_code' => 'required|numeric|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['success' => false, 'error' => 'User not found.'], 404);
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return response()->json(['success' => false, 'error' => 'OTP has expired.'], 400);
        }

        if (!hash_equals((string) $user->otp_code, (string) $request->otp_code)) {
            return response()->json(['success' => false, 'error' => 'Invalid OTP.'], 400);
        }

        $user->update([
            'is_verified' => true,
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        return response()->json(['success' => true, 'message' => 'Email verified successfully!']);
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['success' => false, 'error' => 'User not found.'], 404);
        }

        $otp = rand(100000, 999999);
        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        $this->sendEmailViaBrevo($request->email, $user->name, $otp);

        return response()->json(['success' => true, 'message' => 'New OTP sent successfully!']);
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Generate a unique reset token
        $token = Str::random(64);

        // Store token in the users table
        $user = User::where('email', $request->email)->first();
        $user->password_reset_token = $token;
        $user->password_reset_expires_at = Carbon::now()->addMinutes(60); // Valid for 1 hour
        $user->save();

        // Generate reset link
        $resetLink = url('/reset-password/' . $token);

        // Send email via Brevo
        $this->sendResetEmailViaBrevo($user->email, $user->name, $resetLink);

        return response()->json(['success' => true, 'message' => 'Password reset link sent!']);
    }

    // Show Reset Password Form
    public function showResetForm($token)
    {
        // Check if the token is valid
        $user = \App\Models\User::where('password_reset_token', $token)
            ->where('password_reset_expires_at', '>', Carbon::now())
            ->first();
    
        // If token is invalid or expired, redirect to login
        if (!$user) {
            return redirect()->route('user.login')->with('error', 'Invalid or expired reset link. Please request a new one.');
        }
    
        return view('user.reset-password', ['token' => $token]);
    }

    // Handle Password Reset
 
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);
    
        // Find user by token
        $user = \App\Models\User::where('password_reset_token', $request->token)
            ->where('password_reset_expires_at', '>', Carbon::now())
            ->first();
    
        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Invalid or expired reset token.']);
        }
    
        // Update password
        $user->password = Hash::make($request->password);
        $user->password_reset_token = null;
        $user->password_reset_expires_at = null;
        $user->save();
        return redirect()->route('user.login')->with('success', 'Your password has been reset successfully. You can now log in.');

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
        try {
            // Fetch the logged-in user
            $loggedUser = User::find(session('LoggedUserInfo'));
    
            if (!$loggedUser) {
                return redirect()->route('user.login')
                    ->with('fail', 'You must be logged in to access the profile.');
            }
    
            // Validate input
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'country' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'medical_history' => 'nullable|string',
                'symptoms' => 'nullable|array',
                'symptoms.*' => 'string',
                'visual_acuity' => 'nullable|string|max:50',
                'eye_condition' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Convert symptoms array to JSON
            if ($request->has('symptoms')) {
                $validatedData['symptoms'] = json_encode($request->symptoms);
            }
    
            // Handle profile image
            if ($request->hasFile('image')) {
                if ($loggedUser->image) {
                    $oldImagePath = storage_path('app/public/' . $loggedUser->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
    
                $imageFile = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imagePath = $imageFile->storeAs('profile', $imageName, 'public');
    
                $validatedData['image'] = $imagePath;
            }
    
            // Update profile
            $loggedUser->update($validatedData);
    
            return redirect()->back()->with('success', 'Profile updated successfully!');
    
        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
    
            return redirect()->back()
                ->with('error', 'An error occurred while updating your profile. Please try again.')
                ->withInput();
        }
    }
    
    public function doctors(Request $request)
    {
        // Retrieve the logged-in user info
        $userId = $request->session()->get('LoggedUserInfo');
        $user = User::find($userId);
        
        // Get unique sub-specializations for the dropdown
        $subSpecializations = Doctor::where('status', 'active')
            ->where('is_verified', true)
            ->whereNotNull('sub_specialization')
            ->distinct()
            ->pluck('sub_specialization')
            ->filter()
            ->values();
        
        // Initialize the query for doctors
        $query = Doctor::where('status', 'active')->where('is_verified', true);
        
        // Filter by name
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        
        // Filter by sub-specialization
        if ($request->has('sub_specialization') && $request->sub_specialization != '') {
            $query->where('sub_specialization', $request->sub_specialization);
        }
        
        // Filter by day and time
        if ($request->has('day') && $request->day != '') {
            $day = strtolower($request->day);
            $query->whereRaw("JSON_EXTRACT(availability, '$." . $day . ".enabled') = true");
            
            if ($request->has('time') && $request->time != '') {
                $time = $request->time;
                switch($time) {
                    case 'Morning':
                        $query->whereRaw("JSON_EXTRACT(availability, '$." . $day . ".start') <= '12:00'");
                        break;
                    case 'Afternoon':
                        $query->whereRaw("JSON_EXTRACT(availability, '$." . $day . ".start') <= '17:00'")
                              ->whereRaw("JSON_EXTRACT(availability, '$." . $day . ".end') >= '13:00'");
                        break;
                    case 'Evening':
                        $query->whereRaw("JSON_EXTRACT(availability, '$." . $day . ".end') >= '18:00'");
                        break;
                }
            }
        }
        
        // Order doctors by name
        $doctors = $query->orderBy('name')->paginate(9)->appends($request->all());
        
        return view('doctors', [
            'user' => $user,
            'doctors' => $doctors,
            'LoggedUserInfo' => $user,
            'subSpecializations' => $subSpecializations
        ]);
    }

    public function doctorProfile($id)
    {
        $doctor = Doctor::findOrFail($id);
        $userId = session('LoggedUserInfo');
        $user = User::find($userId);

        // Debug bank details
        \Log::info('Doctor Bank Details: ' . print_r($doctor->bankdetails, true));

        return view('doctor-profile', [
            'doctor' => $doctor,
            'user' => $user,
            'LoggedUserInfo' => $user
        ]);
    }

    public function requestAppointment(Request $request)
    {
        try {
            $request->validate([
                'doctor_id' => 'required|exists:doctors,id',
                'appointment_date' => 'required|date|after:today',
                'appointment_time' => 'required',
                'reason' => 'required|string|max:500'
            ]);

            // Check if user is logged in
            $userId = session('LoggedUserInfo');
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to book an appointment'
                ], 401);
            }

            // Create appointment request
            $appointment = new Appointment();
            $appointment->user_id = $userId;
            $appointment->doctor_id = $request->doctor_id;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->appointment_time = $request->appointment_time;
            $appointment->reason = $request->reason;
            $appointment->status = 'pending';
            $appointment->save();

            return response()->json([
                'success' => true,
                'message' => 'Appointment request sent successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error('Appointment request error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request'
            ], 500);
        }
    }

    public function appointments(Request $request)
    {
        $userId = session('LoggedUserInfo');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access your appointments');
        }

        $query = Appointment::with('doctor')
            ->where('user_id', $userId);

        // Apply status filter if provided
        if ($request->has('status') && $request->status !== 'all') {
            if ($request->status === 'today') {
                $today = Carbon::now();
                $query->whereRaw('DATE_FORMAT(appointment_date, "%m-%d") = ?', [$today->format('m-d')])
                      ->where('status', '!=', 'cancelled')
                      ->where('status', '!=', 'completed');
            } else {
                $query->where('status', $request->status);
            }
        }

        $appointments = $query->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->paginate(5);

        return view('user.appointments', [
            'appointments' => $appointments,
            'LoggedUserInfo' => $user
        ]);
    }

    public function downloadAppointmentPDF($id)
    {
        try {
            $userId = session('LoggedUserInfo');
            if (!$userId) {
                return redirect()->route('user.login')->with('error', 'You must be logged in to download appointment details');
            }

            $appointment = Appointment::with(['user', 'doctor'])
                ->where('id', $id)
                ->where('user_id', $userId)
                ->firstOrFail();

            // Determine if this is a report or receipt based on appointment status
            $isReport = $appointment->status === 'completed';
            $view = $isReport ? 'pdf.appointment' : 'pdf.receipt';
            $filename = $isReport ? 'appointment-report-' : 'appointment-receipt-';
            
            $pdf = PDF::loadView($view, compact('appointment'));
            
            return $pdf->download($filename . $appointment->id . '.pdf');
        } catch (\Exception $e) {
            \Log::error('Appointment PDF download error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while generating the PDF');
        }
    }
}