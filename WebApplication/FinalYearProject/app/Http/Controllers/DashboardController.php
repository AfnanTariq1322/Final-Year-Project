<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function register()
    {
        return view('doctor.register');
    }

    public function login()
    {
        return view('doctor.login');
    }

    public function save(Request $request)
    {
        try {
            \Log::info('Registration attempt for email: ' . $request->email);
            \Log::info('Request data: ' . json_encode($request->all()));

            // Validate user input
            $validator = \Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:doctors',
                'password' => 'required|string|min:8|regex:/^\S*$/',
                'confirm_password' => 'required|string|same:password',
            ], [
                'email.unique' => 'This email is already registered.',
                'password.min' => 'Password must be at least 8 characters long.',
                'confirm_password.same' => 'The confirm password must match the password.',
            ]);

            if ($validator->fails()) {
                \Log::error('Validation failed: ' . json_encode($validator->errors()));
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Generate OTP
            $otp = rand(100000, 999999);
            $otpExpiresAt = now()->addMinutes(10);

            \Log::info('Creating doctor record for: ' . $request->email);

            // Create doctor record with default values
            $doctor = Doctor::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'specialization' => 'Ophthalmologist', // Default value
                'otp_code' => $otp,
                'otp_expires_at' => $otpExpiresAt,
                'is_verified' => false,
                'status' => 'inactive',
                'consultation_fee' => 0.00
            ]);

            if (!$doctor) {
                \Log::error('Failed to create doctor record');
                throw new \Exception('Failed to create doctor record');
            }

            \Log::info('Doctor record created successfully with ID: ' . $doctor->id);

            // Send OTP via email
            try {
                $this->sendEmailViaBrevo($request->email, $request->name, $otp);
                \Log::info('OTP email sent successfully');
            } catch (\Exception $e) {
                \Log::error('Email sending error: ' . $e->getMessage());
                // Continue even if email fails
            }

            return response()->json([
                'success' => true,
                'message' => 'Registration successful. Please verify your OTP.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Doctor registration error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'error' => 'An error occurred during registration. Please try again.'
            ], 500);
        }
    }

    public function check(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8|max:12'
            ]);

            // Find doctor by email
            $doctorInfo = Doctor::where('email', $request->email)->first();

            if (!$doctorInfo) {
                return response()->json(['success' => false, 'error' => 'Email not found.']);
            }

            // Verify password
            if (!Hash::check($request->password, $doctorInfo->password)) {
                return response()->json(['success' => false, 'error' => 'Incorrect password.']);
            }

            // Check if the email is verified
            if (!$doctorInfo->is_verified) {
                return response()->json([
                    'success' => false,
                    'otp_required' => true,
                    'email' => $request->email
                ]);
            }

            // Check if doctor status is inactive
            if ($doctorInfo->status === 'inactive') {
                return response()->json([
                    'success' => false,
                    'error' => 'Your account is currently inactive. Please wait for admin approval.'
                ]);
            }

            // Set session variables
            session([
                'LoggedDoctorInfo' => $doctorInfo->id,
                'LoggedDoctorName' => $doctorInfo->name,
            ]);

            return response()->json(['success' => true, 'redirect' => route('doctor.dashboard')]);
        } catch (\Exception $e) {
            \Log::error('Doctor login error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'An error occurred during login. Please try again.'
            ], 500);
        }
    }

    public function logout()
    {
        if (session()->has('LoggedDoctorInfo')) {
            session()->forget('LoggedDoctorInfo');
        }
        session()->flush();

        return redirect()->route('home');
    }

    public function dashboard()
    {
        try {
            $doctorId = session('LoggedDoctorInfo');
            $doctor = Doctor::find($doctorId);

            if (!$doctor) {
                return redirect('doctor/login')->with('fail', 'You must be logged in to access the dashboard');
            }

            // Get doctor's appointments, patients, etc.
            $appointments = []; // Add your appointment logic here
            $patients = []; // Add your patient logic here

            return view('doctor.dashboard', [
                'doctor' => $doctor,
                'appointments' => $appointments,
                'patients' => $patients
            ]);
        } catch (\Exception $e) {
            \Log::error('Doctor dashboard error: ' . $e->getMessage());
            return redirect('doctor/login')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function profile()
    {
        try {
            $doctorId = session('LoggedDoctorInfo');
            $doctor = Doctor::find($doctorId);

            if (!$doctor) {
                return redirect('doctor/login')->with('fail', 'You must be logged in to access your profile');
            }

            return view('doctor.profile', ['doctor' => $doctor]);
        } catch (\Exception $e) {
            \Log::error('Doctor profile error: ' . $e->getMessage());
            return redirect('doctor/login')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $doctorId = session('LoggedDoctorInfo');
            $doctor = Doctor::find($doctorId);

            if (!$doctor) {
                return redirect('doctor/login')->with('fail', 'You must be logged in to update your profile');
            }

            // Validate input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'specialization' => 'required|string|max:255',
                'sub_specialization' => 'nullable|string|max:255',
                'experience_years' => 'required|integer|min:0',
                'qualifications' => 'required|string',
                'clinic_address' => 'required|string',
                'contact_number' => 'required|string|max:20',
                'consultation_fee' => 'required|numeric|min:0',
                'bio' => 'nullable|string',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle profile image
            if ($request->hasFile('profile_image')) {
                if ($doctor->profile_image) {
                    $oldImagePath = storage_path('app/public/' . $doctor->profile_image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $imageFile = $request->file('profile_image');
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imagePath = $imageFile->storeAs('doctor_profile', $imageName, 'public');

                $validatedData['profile_image'] = $imagePath;
            }

            // Handle availability data
            $availability = [];
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            
            foreach ($days as $day) {
                $isEnabled = $request->input("availability.{$day}.enabled") === 'on';
                $startTime = $request->input("availability.{$day}.start", '09:00');
                $endTime = $request->input("availability.{$day}.end", '17:00');

                $availability[$day] = [
                    'enabled' => $isEnabled,
                    'start' => $startTime,
                    'end' => $endTime
                ];
            }

            // Convert availability array to JSON and add to validated data
            $validatedData['availability'] = json_encode($availability);

            // Handle bank details
            $bankDetails = [];
            if ($request->has('bankdetails')) {
                foreach ($request->bankdetails as $bank) {
                    if (!empty($bank['bank_name']) && !empty($bank['account_name']) && !empty($bank['account_number'])) {
                        $bankDetails[] = [
                            'bank_name' => $bank['bank_name'],
                            'account_name' => $bank['account_name'],
                            'account_number' => $bank['account_number']
                        ];
                    }
                }
            }
            $validatedData['bankdetails'] = json_encode($bankDetails);

            // Update profile
            $doctor->update($validatedData);

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Doctor profile update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred while updating your profile. Please try again.')
                ->withInput();
        }
    }

    public function verify(Request $request)
    {
        try {
            $email = $request->query('email');
            if (!$email) {
                return redirect()->route('doctor.login')->with('error', 'Invalid verification request');
            }

            return view('doctor.verify', ['email' => $email]);
        } catch (\Exception $e) {
            \Log::error('Doctor verify error: ' . $e->getMessage());
            return redirect()->route('doctor.login')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'email' => 'required|email',
                'otp_code' => 'required|numeric|digits:6'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Invalid OTP format'
                ], 422);
            }

            $doctor = Doctor::where('email', $request->email)->first();

            if (!$doctor) {
                return response()->json([
                    'success' => false,
                    'error' => 'Doctor not found'
                ], 404);
            }

            if ($doctor->otp_code != $request->otp_code) {
                return response()->json([
                    'success' => false,
                    'error' => 'Invalid OTP'
                ], 400);
            }

            if (now()->gt($doctor->otp_expires_at)) {
                return response()->json([
                    'success' => false,
                    'error' => 'OTP has expired'
                ], 400);
            }

            $doctor->update([
                'is_verified' => true,
                'otp_code' => null,
                'otp_expires_at' => null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Email verified successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Doctor OTP verification error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'An error occurred during verification. Please try again.'
            ], 500);
        }
    }

    public function resendOtp(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'email' => 'required|email'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Invalid email'
                ], 422);
            }

            $doctor = Doctor::where('email', $request->email)->first();

            if (!$doctor) {
                return response()->json([
                    'success' => false,
                    'error' => 'Doctor not found'
                ], 404);
            }

            $otp = rand(100000, 999999);
            $otpExpiresAt = now()->addMinutes(10);

            $doctor->update([
                'otp_code' => $otp,
                'otp_expires_at' => $otpExpiresAt
            ]);

            $this->sendEmailViaBrevo($request->email, $doctor->name, $otp);

            return response()->json([
                'success' => true,
                'message' => 'New OTP sent successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Doctor OTP resend error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while sending OTP. Please try again.'
            ], 500);
        }
    }

    public function appointments()
    {
        try {
            $doctorId = session('LoggedDoctorInfo');
            $doctor = Doctor::find($doctorId);

            if (!$doctor) {
                return redirect('doctor/login')->with('fail', 'You must be logged in to view appointments');
            }

            // Get doctor's appointments
            $appointments = []; // Add your appointment logic here

            return view('doctor.appointments', [
                'doctor' => $doctor,
                'appointments' => $appointments
            ]);
        } catch (\Exception $e) {
            \Log::error('Doctor appointments error: ' . $e->getMessage());
            return redirect('doctor/login')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function test()
    {
        \Log::info('Test route accessed');
        return view('doctor.test');
    }

    private function sendEmailViaBrevo($email, $name, $otp)
    {
        try {
            $apiKey = "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";

            $data = [
                "sender" => [
                    "name" => "Fundus Image Analysis",
                    "email" => "afnantariq715@gmail.com"
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
        } catch (\Exception $e) {
            \Log::error('Email sending error: ' . $e->getMessage());
        }
    }
} 