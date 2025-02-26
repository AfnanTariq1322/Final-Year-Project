<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

 use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        try {
            $validated = $request->validate([
                'newsletter_email' => 'required|email',
            ]);
    
            // Check if email is already subscribed
            if (NewsletterSubscriber::where('email', $request->newsletter_email)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are already subscribed to our newsletter!'
                ], 400);
            }
    
            // Save email in database
            $subscriber = NewsletterSubscriber::create([
                'email' => $request->newsletter_email,
            ]);
    
            // Send welcome email via Brevo
            $this->sendWelcomeEmailViaBrevo($request->newsletter_email);
    
            return response()->json(['success' => true, 'message' => 'Thank you for subscribing!']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
    
    private function sendWelcomeEmailViaBrevo($email)
    {
        $apiKey = "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";

        $data = [
            "sender" => [
                "name" => "Fundus Image Analysis",
                "email" => "afnantariq715@gmail.com"
            ],
            "to" => [
                [
                    "email" => $email
                ]
            ],
            "subject" => "Welcome to Our Newsletter!",
            "htmlContent" => view('emails.newsletter_welcome')->render()
        ];

        $response = Http::withHeaders([
            "accept" => "application/json",
            "api-key" => $apiKey,
            "content-type" => "application/json"
        ])->post("https://api.brevo.com/v3/smtp/email", $data);

        if ($response->failed()) {
            Log::error("Brevo Email Error: " . $response->body());
        } else {
            Log::info("Newsletter email sent successfully via Brevo.");
        }
    }
}
