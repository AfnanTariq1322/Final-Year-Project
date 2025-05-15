<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Appointment;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\Facades\Image;

class DoctorController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function save(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:doctors',
                'password' => 'required|string|min:5|max:12',
                'confirm_password' => 'required|same:password'
            ]);

            // Create doctor record
            $doctor = new Doctor;
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->password = Hash::make($request->password);
            $doctor->otp_code = rand(100000, 999999);
            $doctor->otp_expires_at = now()->addMinutes(10);
            $doctor->is_verified = 0;
            $doctor->status = 'inactive';
            $doctor->save();

            // Send verification email
            Mail::send('emails.otp', ['otp' => $doctor->otp_code, 'name' => $doctor->name], function($message) use ($doctor) {
                $message->to($doctor->email);
                $message->subject('Verify Your Email - Fundus Disease Analysis');
            });

            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Please verify your email.'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Doctor registration error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);

        $doctor = Doctor::where('email', '=', $request->email)->first();
        
        if ($doctor) {
            if (Hash::check($request->password, $doctor->password)) {
                if ($doctor->is_verified == 0) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Please verify your email first.',
                        'otp_required' => true,
                        'email' => $doctor->email
                    ]);
                }
                if ($doctor->status == 'inactive') {
                    return response()->json([
                        'success' => false,
                        'error' => 'Your account is not active. Please contact admin.'
                    ]);
                }
                $request->session()->put('loginId', $doctor->id);
                return response()->json([
                    'success' => true,
                    'redirect' => route('doctor.dashboard')
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'Password does not match.'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'error' => 'This email is not registered.'
            ]);
        }
    }

    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect()->route('doctor.login');
        }
    }

    public function dashboard()
    {
        $doctorId = Session::get('loginId');
        if (!$doctorId) {
            return redirect()->route('doctor.login')->with('fail', 'You must be logged in to access this page');
        }

        $doctor = Doctor::findOrFail($doctorId);
        
        // Get today's date
        $today = now()->format('Y-m-d');
        
        // Get today's appointments (excluding completed and pending)
        $todayAppointments = Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', $today)
            ->whereNotIn('status', ['completed', 'pending'])
            ->count();
            
        $completedAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'completed')
            ->count();
            
        $pendingAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'pending')
            ->count();
        
        // Get upcoming appointments (today's confirmed appointments)
        $upcomingAppointments = Appointment::with(['user'])
            ->where('doctor_id', $doctorId)
            ->where('status', 'confirmed')
            ->whereDate('appointment_date', now()->format('Y-m-d'))
            ->orderBy('appointment_time', 'asc')
            ->get();

        return view('doctor_dashboard', compact(
            'doctor',
            'todayAppointments',
            'completedAppointments',
            'pendingAppointments',
            'upcomingAppointments'
        ));
    }

    public function profile()
    {
        $doctor = array();
        if (Session::has('loginId')) {
            $doctor = Doctor::where('id', '=', Session::get('loginId'))->first();
        }
        return view('doctor_profile', compact('doctor'));
    }

    public function verify()
    {
        return view('doctor.verify');
    }

    public function verifyOtp(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'otp_code' => 'required|numeric'
            ]);

            $doctor = Doctor::where('email', $request->email)
                          ->where('otp_code', $request->otp_code)
                          ->first();
            
            if (!$doctor) {
                return response()->json([
                    'success' => false,
                    'error' => 'Invalid OTP or email.'
                ], 422);
            }

            if ($doctor->otp_expires_at && now()->isAfter($doctor->otp_expires_at)) {
                return response()->json([
                    'success' => false,
                    'error' => 'OTP has expired. Please request a new one.'
                ], 422);
            }

            $doctor->is_verified = 1;
            $doctor->otp_code = null;
            $doctor->otp_expires_at = null;
            $doctor->save();

            return response()->json([
                'success' => true,
                'message' => 'Email verified successfully!'
            ]);

        } catch (\Exception $e) {
            \Log::error('OTP Verification Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to verify OTP. Please try again.'
            ], 500);
        }
    }

    public function resendOtp(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email'
            ]);

            $doctor = Doctor::where('email', $request->email)->first();
            
            if (!$doctor) {
                return response()->json([
                    'success' => false,
                    'error' => 'Email not found.'
                ], 404);
            }

            // Generate new OTP
            $doctor->otp_code = rand(100000, 999999);
            $doctor->otp_expires_at = now()->addMinutes(10);
            $doctor->save();

            // Send email with new OTP
            Mail::send('emails.otp', ['otp' => $doctor->otp_code, 'name' => $doctor->name], function($message) use ($doctor) {
                $message->to($doctor->email);
                $message->subject('New OTP for Email Verification - Fundus Disease Analysis');
            });

            return response()->json([
                'success' => true,
                'message' => 'A new OTP has been sent to your email.'
            ]);

        } catch (\Exception $e) {
            \Log::error('OTP Resend Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to resend OTP. Please try again.'
            ], 500);
        }
    }
    public function updateProfile(Request $request)
    {
        try {
            $doctorId = Session::get('loginId');
            $doctor = Doctor::where('id', '=', $doctorId)->first();

            if (!$doctor) {
                return redirect()->route('doctor.login')->with('fail', 'You must be logged in to update your profile');
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
                'map' => 'nullable|string',
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

    public function appointments()
    {
        try {
            $doctorId = Session::get('loginId');
            if (!$doctorId) {
                return redirect()->route('doctor.login')->with('fail', 'You must be logged in to view appointments');
            }

            $doctor = Doctor::findOrFail($doctorId);
            $status = request('status', 'pending');
            
            $appointments = Appointment::with(['user'])
                ->where('doctor_id', $doctorId)
                ->when($status, function($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->orderBy('appointment_date', 'desc')
                ->orderBy('appointment_time', 'asc')
                ->get();

            return view('doctor_appointments', compact('doctor', 'appointments', 'status'));
        } catch (\Exception $e) {
            \Log::error('Doctor appointments error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while fetching appointments');
        }
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        try {
            $doctorId = Session::get('loginId');
            if (!$doctorId) {
                return redirect()->route('doctor.login')->with('error', 'You must be logged in to update appointment status');
            }

            $request->validate([
                'status' => 'required|in:pending,confirmed,cancelled'
            ]);

            $appointment = Appointment::where('id', $id)
                ->where('doctor_id', $doctorId)
                ->first();

            if (!$appointment) {
                return redirect()->back()->with('error', 'Appointment not found');
            }

            // Only allow status changes from pending to confirmed or cancelled
            if ($appointment->status != 'pending' && $request->status != $appointment->status) {
                return redirect()->back()->with('error', 'You can only update the status of pending appointments');
            }

            $appointment->status = $request->status;
            $appointment->save();

            // Send notification to user about status update
            $this->sendAppointmentStatusNotification($appointment);

            $message = $request->status == 'confirmed' ? 'Appointment confirmed successfully' : 
                      ($request->status == 'cancelled' ? 'Appointment cancelled successfully' : 
                      'Appointment status updated successfully');

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            \Log::error('Appointment status update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating appointment status');
        }
    }
    public function completedappointments()
    {
        $doctorId = Session::get('loginId');
        if (!$doctorId) {
            return redirect()->route('doctor.login')->with('fail', 'You must be logged in to view appointments');
        }

        $doctor = Doctor::findOrFail($doctorId);
        $appointments = Appointment::with(['user'])
            ->where('doctor_id', $doctorId)
            ->whereIn('status', ['confirmed', 'completed'])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'asc')
            ->get();

        return view('doctor_completedappointments', compact('doctor', 'appointments'));
    }

    public function downloadAppointmentPDF($id)
    {
        try {
            $doctorId = Session::get('loginId');
            if (!$doctorId) {
                return redirect()->route('doctor.login')->with('error', 'You must be logged in to download appointment details');
            }

            $appointment = Appointment::with(['user', 'doctor'])
                ->where('id', $id)
                ->where('doctor_id', $doctorId)
                ->firstOrFail();

            $pdf = PDF::loadView('pdf.appointment', compact('appointment'));
            
            return $pdf->download('appointment-' . $appointment->id . '.pdf');
        } catch (\Exception $e) {
            \Log::error('Appointment PDF download error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while generating the PDF');
        }
    }

    public function downloadUserReport($id)
    {
        try {
            $doctorId = Session::get('loginId');
            if (!$doctorId) {
                return redirect()->route('doctor.login')->with('error', 'You must be logged in to download reports');
            }

            $appointment = Appointment::with(['user', 'doctor'])
                ->where('id', $id)
                ->where('doctor_id', $doctorId)
                ->firstOrFail();

            if (!$appointment->user_report) {
                return redirect()->back()->with('error', 'No report available for this appointment');
            }

            // Decode the user report JSON
            $reportData = json_decode($appointment->user_report, true);

            // Generate PDF using the report data
            $pdf = PDF::loadView('pdf.user_report', [
                'appointment' => $appointment,
                'reportData' => $reportData
            ]);
            
            return $pdf->download('patient-report-' . $appointment->id . '.pdf');
        } catch (\Exception $e) {
            \Log::error('User report PDF download error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while generating the PDF');
        }
    }

    private function sendAppointmentStatusNotification($appointment)
    {
        try {
            $user = $appointment->user;
            $doctor = $appointment->doctor;
            
            // Format appointment date and time
            $appointmentDate = \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y');
            $appointmentTime = \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A');
            
            // Create Google Maps search URL from clinic address
            $mapUrl = null;
            if ($doctor->clinic_address) {
                $encodedAddress = urlencode($doctor->clinic_address);
                $mapUrl = "https://www.google.com/maps/search/?api=1&query={$encodedAddress}";
            }
            
            // Prepare email content
            $htmlContent = "
                <html>
                <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                    <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                        <div style='text-align: center; margin-bottom: 20px;'>
                            <div style='display: inline-block; background: #d4edda; color: #155724; padding: 10px 20px; border-radius: 20px; font-weight: bold;'>
                                <i class='fas fa-check-circle' style='margin-right: 5px;'></i> Appointment Confirmed
                            </div>
                        </div>
                        
                        <h2 style='color: #604BB0; text-align: center;'>Appointment Confirmation</h2>
                        
                        <p>Dear {$user->name},</p>
                        
                        <p>Your appointment with Dr. {$doctor->name} has been confirmed. Here are the details:</p>
                        
                        <div style='background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                            <h3 style='color: #604BB0; margin-top: 0;'>Appointment Details</h3>
                            <p><strong>Date:</strong> {$appointmentDate}</p>
                            <p><strong>Time:</strong> {$appointmentTime}</p>
                            <p><strong>Doctor:</strong> Dr. {$doctor->name}</p>
                            <p><strong>Specialization:</strong> {$doctor->specialization}</p>
                            <p><strong>Clinic Address:</strong> {$doctor->clinic_address}</p>
                            " . ($mapUrl ? 
                                "<div style='margin: 15px 0; text-align: center;'>
                                    <a href='{$mapUrl}' target='_blank' style='display: inline-block; background: #604BB0; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;'>
                                        <i class='fas fa-map-marker-alt' style='margin-right: 8px;'></i> Find Clinic on Google Maps
                                    </a>
                                    <p style='margin-top: 10px; font-size: 0.9em; color: #666;'>
                                        Click the button above to find the clinic location on Google Maps and get directions.
                                    </p>
                                </div>" : "") . "
                            <p><strong>Contact Number:</strong> {$doctor->contact_number}</p>
                        </div>
                        
                        <div style='background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                            <h3 style='color: #604BB0; margin-top: 0;'>Important Instructions</h3>
                            <ul>
                                <li>Please arrive 15 minutes before your scheduled appointment time.</li>
                                <li>Bring your payment receipt with you.</li>
                                <li>Carry any previous medical reports or prescriptions if available.</li>
                                <li>Wear a mask and follow all clinic safety protocols.</li>
                            </ul>
                        </div>
                        
                        <div style='background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                            <h3 style='color: #604BB0; margin-top: 0;'>Payment Information</h3>
                            <p>Please show your payment receipt at the reception. If you haven't made the payment yet, please do so before your appointment.</p>
                            " . ($appointment->payment_receipt ? 
                                "<p>Your payment receipt is attached with this email.</p>" : 
                                "<p>Please make the payment of {$doctor->consultation_fee} before your appointment.</p>") . "
                        </div>
                        
                        <div style='text-align: center; margin: 20px 0;'>
                            <div style='display: inline-block; background: #604BB0; color: white; padding: 10px 20px; border-radius: 5px;'>
                                <i class='fas fa-calendar-check'></i> Appointment Booked
                            </div>
                        </div>
                        
                        <p>If you need to reschedule or cancel your appointment, please contact the clinic at least 24 hours in advance.</p>
                        
                        <p>Best regards,<br>Fundus Disease Analysis Team</p>
                    </div>
                </body>
                </html>
            ";

            // Prepare email data for Brevo
            $data = [
                "sender" => [
                    "name" => "Fundus Disease Analysis",
                    "email" => "afnantariq715@gmail.com"
                ],
                "to" => [
                    [
                        "name" => $user->name,
                        "email" => $user->email
                    ]
                ],
                "subject" => "Appointment Confirmation with Dr. {$doctor->name}",
                "htmlContent" => $htmlContent
            ];

            // Add attachment if payment receipt exists
            if ($appointment->payment_receipt) {
                $receiptPath = storage_path('app/public/' . $appointment->payment_receipt);
                if (file_exists($receiptPath)) {
                    $data["attachment"] = [
                        [
                            "content" => base64_encode(file_get_contents($receiptPath)),
                            "name" => "payment_receipt.jpg"
                        ]
                    ];
                }
            }

            // Send email via Brevo
            $apiKey = "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";
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.brevo.com/v3/smtp/email");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "accept: application/json",
                "api-key: $apiKey",
                "content-type: application/json"
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

            $response = curl_exec($ch);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($curlError) {
                \Log::error("Appointment confirmation email error: " . $curlError);
            } else {
                \Log::info("Appointment confirmation email sent successfully");
            }
        } catch (\Exception $e) {
            \Log::error('Appointment notification error: ' . $e->getMessage());
        }
    }

    public function completeAppointment(Request $request, $id)
    {
        try {
            $doctorId = Session::get('loginId');
            if (!$doctorId) {
                return redirect()->route('doctor.login')->with('error', 'You must be logged in to complete appointments');
            }

            $request->validate([
                'notes' => 'required|string|min:10'
            ]);

            $appointment = Appointment::where('id', $id)
                ->where('doctor_id', $doctorId)
                ->where('status', 'confirmed')
                ->first();

            if (!$appointment) {
                return redirect()->back()->with('error', 'Appointment not found or cannot be completed');
            }

            $appointment->status = 'completed';
            $appointment->notes = $request->notes;
            $appointment->save();

            // Send notification to user about completed appointment
            $this->sendAppointmentCompletionNotification($appointment);

            return redirect()->back()->with('success', 'Appointment marked as completed successfully');
        } catch (\Exception $e) {
            \Log::error('Appointment completion error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while completing the appointment');
        }
    }

    private function sendAppointmentCompletionNotification($appointment)
    {
        try {
            $user = $appointment->user;
            $doctor = $appointment->doctor;
            
            // Format appointment date and time
            $appointmentDate = \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y');
            $appointmentTime = \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A');
            
            // Prepare email content
            $htmlContent = "
                <html>
                <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                    <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                        <div style='text-align: center; margin-bottom: 20px;'>
                            <div style='display: inline-block; background: #d4edda; color: #155724; padding: 10px 20px; border-radius: 20px; font-weight: bold;'>
                                <i class='fas fa-check-circle' style='margin-right: 5px;'></i> Appointment Completed
                            </div>
                        </div>
                        
                        <h2 style='color: #604BB0; text-align: center;'>Appointment Summary</h2>
                        
                        <p>Dear {$user->name},</p>
                        
                        <p>Your appointment with Dr. {$doctor->name} has been completed. Here are the details:</p>
                        
                        <div style='background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                            <h3 style='color: #604BB0; margin-top: 0;'>Appointment Details</h3>
                            <p><strong>Date:</strong> {$appointmentDate}</p>
                            <p><strong>Time:</strong> {$appointmentTime}</p>
                            <p><strong>Doctor:</strong> Dr. {$doctor->name}</p>
                            <p><strong>Specialization:</strong> {$doctor->specialization}</p>
                        </div>
                        
                        <div style='background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                            <h3 style='color: #604BB0; margin-top: 0;'>Doctor's Notes</h3>
                            <p>{$appointment->notes}</p>
                        </div>
                        
                        <p>If you have any questions or need further assistance, please don't hesitate to contact us.</p>
                        
                        <p>Best regards,<br>Fundus Disease Analysis Team</p>
                    </div>
                </body>
                </html>
            ";

            // Prepare email data for Brevo
            $data = [
                "sender" => [
                    "name" => "Fundus Disease Analysis",
                    "email" => "afnantariq715@gmail.com"
                ],
                "to" => [
                    [
                        "name" => $user->name,
                        "email" => $user->email
                    ]
                ],
                "subject" => "Appointment Completed - Dr. {$doctor->name}",
                "htmlContent" => $htmlContent
            ];

            // Send email via Brevo
            $apiKey = "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";
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.brevo.com/v3/smtp/email");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "accept: application/json",
                "api-key: $apiKey",
                "content-type: application/json"
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

            $response = curl_exec($ch);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($curlError) {
                \Log::error("Appointment completion email error: " . $curlError);
            } else {
                \Log::info("Appointment completion email sent successfully");
            }
        } catch (\Exception $e) {
            \Log::error('Appointment completion notification error: ' . $e->getMessage());
        }
    }

    public function fundusAnalysis()
    {
        $doctorId = Session::get('loginId');
        if (!$doctorId) {
            return redirect()->route('doctor.login')->with('fail', 'You must be logged in to access this page');
        }

        $doctor = Doctor::findOrFail($doctorId);
        return view('doctor_fundus_analysis', compact('doctor'));
    }

    public function analyzeFundus(Request $request)
    {
        try {
            $request->validate([
                'fundus_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $imageFile = $request->file('fundus_image');
            
            // Create cURL file
            $curlFile = new \CURLFile(
                $imageFile->getPathname(),
                $imageFile->getMimeType(),
                $imageFile->getClientOriginalName()
            );

            // Initialize cURL session
            $ch = curl_init();
            
            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5000/predict');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ['image' => $curlFile]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            // Execute cURL request
            $response = curl_exec($ch);
            
            // Check for cURL errors
            if (curl_errno($ch)) {
                throw new \Exception('API request failed: ' . curl_error($ch));
            }
            
            // Close cURL session
            curl_close($ch);
            
            // Decode JSON response
            $result = json_decode($response, true);
            
            if (!$result) {
                throw new \Exception('Invalid response from API');
            }

            // Get the predicted class and confidence
            $predictedClass = $result['predicted_class'];
            $confidence = $result['confidence'];
            $probabilities = $result['probabilities'];

            // Map class names to their full names
            $classNames = [
                'AMD' => 'Age-related Macular Degeneration',
                'Cataract' => 'Cataract',
                'DR' => 'Diabetic Retinopathy',
                'Glaucoma' => 'Glaucoma',
                'Hypertensive' => 'Hypertensive Retinopathy',
                'Myopia' => 'Myopia',
                'Normal' => 'Normal',
                'Other' => 'Other Condition'
            ];

            // Prepare conditions array with probabilities
            $conditions = [];
            foreach ($probabilities as $className => $probability) {
                $conditions[] = [
                    'name' => $classNames[$className],
                    'confidence' => $probability
                ];
            }

            // Sort conditions by confidence in descending order
            usort($conditions, function($a, $b) {
                return $b['confidence'] <=> $a['confidence'];
            });

            // Get recommendations based on predicted class
            $recommendations = [];
            $clinicalNotes = [];

            switch ($predictedClass) {
                case 'DR':
                    $recommendations = [
                        'Schedule follow-up appointment',
                        'Monitor blood glucose levels',
                        'Consider retinal photography',
                        'Review diabetes management plan'
                    ];
                    $clinicalNotes = [
                        'Verify presence of microaneurysms and hemorrhages',
                        'Assess severity of diabetic retinopathy',
                        'Check for macular edema',
                        'Review glycemic control history'
                    ];
                    break;
                case 'Glaucoma':
                    $recommendations = [
                        'Schedule follow-up appointment',
                        'Monitor intraocular pressure',
                        'Consider visual field testing',
                        'Review optic nerve head'
                    ];
                    $clinicalNotes = [
                        'Verify optic nerve head changes',
                        'Assess cup-to-disc ratio',
                        'Check for visual field defects',
                        'Review family history of glaucoma'
                    ];
                    break;
                case 'Cataract':
                    $recommendations = [
                        'Schedule follow-up appointment',
                        'Assess visual acuity',
                        'Consider surgical evaluation',
                        'Monitor progression'
                    ];
                    $clinicalNotes = [
                        'Verify lens opacity characteristics',
                        'Assess impact on daily activities',
                        'Check for other ocular conditions',
                        'Review surgical candidacy'
                    ];
                    break;
                case 'AMD':
                    $recommendations = [
                        'Schedule follow-up appointment',
                        'Monitor for vision changes',
                        'Consider Amsler grid testing',
                        'Review risk factors'
                    ];
                    $clinicalNotes = [
                        'Verify presence of drusen',
                        'Assess for geographic atrophy',
                        'Check for neovascular changes',
                        'Review family history of AMD'
                    ];
                    break;
                case 'Hypertensive':
                    $recommendations = [
                        'Schedule follow-up appointment',
                        'Monitor blood pressure',
                        'Consider cardiovascular assessment',
                        'Review medication compliance'
                    ];
                    $clinicalNotes = [
                        'Verify retinal vascular changes',
                        'Assess severity of retinopathy',
                        'Check for optic nerve changes',
                        'Review blood pressure history'
                    ];
                    break;
                case 'Myopia':
                    $recommendations = [
                        'Schedule follow-up appointment',
                        'Update prescription if needed',
                        'Monitor for complications',
                        'Review lifestyle factors'
                    ];
                    $clinicalNotes = [
                        'Verify refractive error',
                        'Assess for myopic degeneration',
                        'Check for retinal changes',
                        'Review progression history'
                    ];
                    break;
                case 'Normal':
                    $recommendations = [
                        'Schedule routine follow-up',
                        'Maintain regular eye exams',
                        'Monitor for any changes',
                        'Review preventive care'
                    ];
                    $clinicalNotes = [
                        'Verify normal retinal appearance',
                        'Assess overall eye health',
                        'Check for any subtle changes',
                        'Review family history'
                    ];
                    break;
                case 'Other':
                    $recommendations = [
                        'Schedule comprehensive evaluation',
                        'Consider additional testing',
                        'Monitor for changes',
                        'Review medical history'
                    ];
                    $clinicalNotes = [
                        'Verify specific retinal findings',
                        'Assess for multiple conditions',
                        'Check for systemic associations',
                        'Review complete medical history'
                    ];
                    break;
            }

            // Prepare analysis results
            $analysisResults = [
                'predicted_class' => $classNames[$predictedClass],
                'confidence' => $confidence,
                'conditions' => $conditions,
                'recommendations' => $recommendations,
                'clinical_notes' => $clinicalNotes
            ];

            $doctorId = Session::get('loginId');
            $doctor = Doctor::findOrFail($doctorId);

            return view('doctor_fundus_analysis', [
                'doctor' => $doctor,
                'analysisResults' => $analysisResults
            ])->with('success', 'Image analyzed successfully');

        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while analyzing the image: ' . $e->getMessage());
        }
    }
} 