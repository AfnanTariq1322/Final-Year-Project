<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppointmentController extends Controller
{
    public function requestAppointment(Request $request)
    {
        try {
            $request->validate([
                'doctor_id' => 'required|exists:doctors,id',
                'appointment_date' => 'required|date|after:today',
                'appointment_time' => 'required',
                'reason' => 'required|string|max:500',
                'payment_receipt' => 'required|file|mimes:jpeg,png,pdf|max:2048',
                'include_report' => 'nullable|boolean',
                'user_report' => 'nullable|json'
            ]);

            // Check if user is logged in
            $userId = session('LoggedUserInfo');
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to book an appointment'
                ], 401);
            }

            // Get the selected appointment date
            $selectedDate = new \DateTime($request->appointment_date);
            $monthStart = new \DateTime($selectedDate->format('Y-m-01'));
            $monthEnd = new \DateTime($selectedDate->format('Y-m-t'));

            // Check if user has already booked 4 appointments with the same doctor this month
            $monthlyAppointments = Appointment::where('user_id', $userId)
                ->where('doctor_id', $request->doctor_id)
                ->whereBetween('appointment_date', [$monthStart, $monthEnd])
                ->where('status', 'pending')
                ->count();

            if ($monthlyAppointments >= 4) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have 4 pending appointments with this doctor. Please wait for the doctor to confirm or reject them before booking more appointments.'
                ], 400);
            }

            // Check if user has already booked an appointment at the same time with the same doctor
            $existingAppointment = Appointment::where('user_id', $userId)
                ->where('doctor_id', $request->doctor_id)
                ->where('appointment_date', $request->appointment_date)
                ->where('appointment_time', $request->appointment_time)
                ->first();

            if ($existingAppointment) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already booked an appointment with this doctor at the same time'
                ], 400);
            }

            // Check if the time slot is already booked by another user
            $timeSlotBooked = Appointment::where('doctor_id', $request->doctor_id)
                ->where('appointment_date', $request->appointment_date)
                ->where('appointment_time', $request->appointment_time)
                ->where('status', '!=', 'cancelled')
                ->exists();

            if ($timeSlotBooked) {
                return response()->json([
                    'success' => false,
                    'message' => 'This time slot is already booked. Please select another time.'
                ], 400);
            }

            // Ensure the payment_receipts directory exists
            if (!Storage::exists('public/payment_receipts')) {
                Storage::makeDirectory('public/payment_receipts');
            }

            // Store the payment receipt with a unique filename
            $file = $request->file('payment_receipt');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $receiptPath = $file->storeAs('payment_receipts', $filename, 'public');

            if (!$receiptPath) {
                throw new \Exception('Failed to store payment receipt');
            }

            // Create appointment request
            $appointmentData = [
                'doctor_id' => $request->doctor_id,
                'user_id' => $userId,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'reason' => $request->reason,
                'payment_receipt' => $receiptPath,
                'status' => 'pending'
            ];

            // Add user report if included
            if ($request->include_report && $request->user_report) {
                $appointmentData['user_report'] = $request->user_report;
            }

            $appointment = Appointment::create($appointmentData);

            return response()->json([
                'success' => true,
                'message' => 'Appointment request sent successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error('Appointment request error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getAppointments()
    {
        $appointments = Appointment::with(['doctor', 'user'])
            ->where('user_id', session('LoggedUserInfo')->id)
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('appointments.index', compact('appointments'));
    }
} 