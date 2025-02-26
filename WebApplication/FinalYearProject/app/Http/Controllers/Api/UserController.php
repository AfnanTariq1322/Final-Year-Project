<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


 use App\Models\Category;
use App\Models\Blog;
 use Illuminate\Support\Facades\Mail;
 use Carbon\Carbon;
  use Illuminate\Support\Facades\Password;
  use Illuminate\Support\Str;
class UserController extends Controller
{

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
    public function register(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|regex:/^\\S*$/',
            'confirm_password' => 'required|string|same:password',
        ], [
            'email.unique' => 'This email is already registered.',
            'password.min' => 'Password must be at least 8 characters long.',
            'confirm_password.same' => 'The confirm password must match the password.',
        ]);

        // If validation fails, return JSON errors
        if ($validator->fails()) {
            Log::error('Validation Failed: ' . json_encode($validator->errors()->toArray()));
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



    public function verifyOtp(Request $request)
    {
        // Manually handle validation to customize error response
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp_code' => 'required|numeric|digits:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }
    
        // Find user by email
        $user = User::where('email', $request->email)->first();
    
        // ✅ Proper error if email does not exist
        if (!$user) {
            return response()->json(['success' => false, 'error' => 'User not found. Please check the email address.'], 404);
        }
    
        // ✅ Check if OTP has expired
        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return response()->json(['success' => false, 'error' => 'OTP has expired.'], 400);
        }
    
        // ✅ Check if OTP is correct
        if (!hash_equals((string) $user->otp_code, (string) $request->otp_code)) {
            return response()->json(['success' => false, 'error' => 'Invalid OTP.'], 400);
        }
    
        // ✅ Mark user as verified and clear OTP fields
        $user->update([
            'is_verified' => true,
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);
    
        return response()->json(['success' => true, 'message' => 'Email verified successfully!']);
    }

 
    public function resendOtp(Request $request)
    {
        // Manually handle validation to show all errors
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }
    
        // Find user by email
        $user = User::where('email', $request->email)->first();
    
        // ✅ Proper error if email does not exist
        if (!$user) {
            return response()->json([
                'success' => false,
                'error' => 'User not found. Please check the email address.',
            ], 404);
        }
    
        // ✅ Generate a new OTP
        $otp = rand(100000, 999999);
        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);
    
        // ✅ Send email with new OTP
        $this->sendEmailViaBrevo($request->email, $user->name, $otp);
    
        return response()->json([
            'success' => true,
            'message' => 'New OTP sent successfully!',
        ]);
    }
    
  
        // LOGIN - No token required
        public function login(Request $request)
        {
            $request->validate([
                'email'    => 'required|email',
                'password' => 'required|min:5|max:12',
            ]);
    
            $user = User::where('email', $request->email)->first();
    
            if (!$user) {
                return response()->json(['success' => false, 'error' => 'Email not found.'], 404);
            }
    
            // Check password before checking verification
            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['success' => false, 'error' => 'Incorrect password.'], 401);
            }
    
            // If the user is not verified, return a proper message
            if (!$user->is_verified) {
                return response()->json([
                    'success'      => false,
                    'otp_required' => true,
                    'message'      => 'Please verify your email first.',
                    'email'        => $request->email,
                ]);
            }
    
            // Generate JWT Token
            $token = JWTAuth::fromUser($user);
    
            return response()->json([
                'success' => true,
                'token'   => $token,
                'user'    => $user
            ]);
        }
    
        // GET AUTHENTICATED USER (me)
        public function me(Request $request)
        {
            // Extract token from header
            $token = $request->header('Authorization');
            if (!$token) {
                return response()->json(['success' => false, 'error' => 'Token not provided'], 401);
            }
            // Remove Bearer prefix if present
            $token = str_replace('Bearer ', '', $token);
    
            try {
                $user = JWTAuth::setToken($token)->authenticate();
                if (!$user) {
                    return response()->json(['success' => false, 'error' => 'User not found'], 404);
                }
                return response()->json(['success' => true, 'user' => $user]);
            } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json(['success' => false, 'error' => 'Token expired'], 401);
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json(['success' => false, 'error' => 'Invalid token'], 401);
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json(['success' => false, 'error' => 'Token error: ' . $e->getMessage()], 401);
            }
        }
    
        // LOGOUT
        public function logout(Request $request)
        {
            $token = $request->header('Authorization');
            if (!$token) {
                return response()->json(['success' => false, 'error' => 'Token not provided'], 401);
            }
            $token = str_replace('Bearer ', '', $token);
            
            try {
                JWTAuth::setToken($token)->invalidate();
                return response()->json(['success' => true, 'message' => 'Logged out successfully']);
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json(['success' => false, 'error' => 'Failed to logout: ' . $e->getMessage()], 400);
            }
        }
    
        // REFRESH TOKEN
        public function refresh(Request $request)
        {
            $token = $request->header('Authorization');
            if (!$token) {
                return response()->json(['success' => false, 'error' => 'Token not provided'], 401);
            }
            $token = str_replace('Bearer ', '', $token);
            
            try {
                $newToken = JWTAuth::refresh($token);
                return response()->json(['success' => true, 'token' => $newToken]);
            } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json(['success' => false, 'error' => 'Token expired, please log in again'], 401);
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json(['success' => false, 'error' => 'Invalid token'], 401);
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json(['success' => false, 'error' => 'Token error: ' . $e->getMessage()], 401);
            }
        }
    
        // DASHBOARD
        public function dashboard(Request $request)
        {
            $token = $request->header('Authorization');
            if (!$token) {
                return response()->json(['success' => false, 'error' => 'Token not provided'], 401);
            }
            $token = str_replace('Bearer ', '', $token);
        
            try {
                $user = JWTAuth::setToken($token)->authenticate();
                if (!$user) {
                    return response()->json(['success' => false, 'error' => 'User not found'], 404);
                }
                return response()->json([
                    'success' => true,
                    'user'    => $user,
                    'message' => 'Welcome to your dashboard!'
                ]);
            } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json(['success' => false, 'error' => 'Token expired. Please log in again.'], 401);
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json(['success' => false, 'error' => 'You must be logged in to access the dashboard'], 401);
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json(['success' => false, 'error' => 'You must be logged in to access the dashboard'], 401);
            }
        }
        
    }
    
    
 