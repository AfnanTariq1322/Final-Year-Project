<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function analyzeFundus(Request $request)
    {
        try {
            \Log::info('Starting fundus analysis request');
            
            $request->validate([
                'fundus_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $imageFile = $request->file('fundus_image');
            \Log::info('Image file received', ['filename' => $imageFile->getClientOriginalName()]);
            
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
            curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Add timeout
            
            \Log::info('Sending request to Python API');
            
            // Execute cURL request
            $response = curl_exec($ch);
            
            // Check for cURL errors
            if (curl_errno($ch)) {
                $error = curl_error($ch);
                \Log::error('cURL Error: ' . $error);
                throw new \Exception('API request failed: ' . $error);
            }
            
            // Close cURL session
            curl_close($ch);
            
            \Log::info('Received response from Python API', ['response' => $response]);
            
            // Decode JSON response
            $result = json_decode($response, true);
            
            if (!$result) {
                \Log::error('Invalid JSON response from API', ['response' => $response]);
                throw new \Exception('Invalid response from API: ' . json_last_error_msg());
            }

            // Get the predicted class and confidence
            $predictedClass = $result['predicted_class'] ?? null;
            $confidence = $result['confidence'] ?? null;
            $probabilities = $result['probabilities'] ?? [];

            if (!$predictedClass || !$confidence) {
                \Log::error('Missing required fields in API response', ['result' => $result]);
                throw new \Exception('Invalid API response format');
            }

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

            if (!isset($classNames[$predictedClass])) {
                \Log::error('Unknown predicted class', ['class' => $predictedClass]);
                throw new \Exception('Unknown condition detected');
            }

            // Prepare conditions array with probabilities
            $conditions = [];
            foreach ($probabilities as $className => $probability) {
                if (isset($classNames[$className])) {
                    $conditions[] = [
                        'name' => $classNames[$className],
                        'confidence' => $probability
                    ];
                }
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
                'clinical_notes' => $clinicalNotes,
                'analysis_date' => now()->format('Y-m-d H:i:s')
            ];

            // Get tips and relief suggestions from Gemini API
            try {
                $geminiResponse = $this->getGeminiTips($predictedClass);
                if ($geminiResponse) {
                    $analysisResults['tips_and_relief'] = $geminiResponse;
                }
            } catch (\Exception $e) {
                \Log::warning('Failed to get Gemini tips: ' . $e->getMessage());
                // Continue without tips if Gemini API fails
            }

            // Store the analysis results in the database
            $userId = $request->session()->get('LoggedUserInfo');
            if ($userId) {
                try {
                    \Log::info('Saving analysis results for user: ' . $userId);
                    
                    // Convert the analysis results to a string
                    $jsonString = json_encode($analysisResults, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                    
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        throw new \Exception('JSON encoding error: ' . json_last_error_msg());
                    }

                    // Update the user's record directly using DB query
                    $updated = \DB::table('users')
                        ->where('id', $userId)
                        ->update(['acute_disease_detected' => $jsonString]);

                    if (!$updated) {
                        throw new \Exception('Failed to update user record');
                    }

                    \Log::info('Analysis results saved successfully');
                    
                } catch (\Exception $e) {
                    \Log::error('Error saving analysis results: ' . $e->getMessage());
                    \Log::error('Stack trace: ' . $e->getTraceAsString());
                    // Continue even if saving fails
                }
            } else {
                \Log::warning('No user found in session when trying to save analysis results');
            }

            return response()->json([
                'success' => true,
                'data' => $analysisResults
            ]);

        } catch (\Exception $e) {
            \Log::error('Fundus Analysis Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while analyzing the image: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getGeminiTips($condition)
    {
        try {
            $apiKey = 'AIzaSyCH7EKIhnIZ7N2iqanc-2ZXEYVQTVp5AHo';
            $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . $apiKey;

            $prompt = "Provide practical tips and relief suggestions for managing {$condition}. Include:\n";
            $prompt .= "1. Daily management tips\n";
            $prompt .= "2. Lifestyle modifications\n";
            $prompt .= "3. Home remedies or relief measures\n";
            $prompt .= "4. Preventive measures\n";
            $prompt .= "Format the response in a clear, concise way.";

            $data = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ];

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);

            $response = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($response, true);
            
            if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                return $result['candidates'][0]['content']['parts'][0]['text'];
            }

            return null;
        } catch (\Exception $e) {
            \Log::error('Gemini API Error: ' . $e->getMessage());
            return null;
        }
    }
} 