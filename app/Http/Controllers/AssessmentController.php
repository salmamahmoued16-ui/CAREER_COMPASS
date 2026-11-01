<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Career;
use App\Models\CareerPrediction;
use App\Models\SalaryPrediction;
use App\Models\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AssessmentController extends Controller
{
    /**
     * Store assessment and get career prediction from AI service.
     */
    public function store(Request $request)
    {
        // 1. Validate assessment data
        $validated = $request->validate([
            'age' => 'required|integer|min:16|max:60',
            'school_university' => 'required|string|max:255',
            'study_year' => 'required|string|max:50',
            'favorite_activity' => 'required|string|max:255',
            'interested_fields' => 'required|string|max:255',
            'current_need' => 'required|string|max:255',
            'join_workshop' => 'required|boolean',
            'commitment_level' => 'required|string|max:255',
            'career_goal' => 'required|string|max:255',
            'biggest_challenge' => 'required|string|max:255',
            'career_awareness' => 'required|boolean',
            'work_preference' => 'required|string|max:255',

            // AI fields
            'education' => 'required|string',
            'specialization' => 'required|string',
            'skills' => 'required|array',
            'skills.*' => 'string',
            'certification' => 'nullable|string',
            'cgpa' => 'required|numeric|min:0|max:100',
        ]);

        // 2. Save assessment
        $assessment = Assessment::create([
            'age' => $validated['age'],
            'school_university' => $validated['school_university'],
            'study_year' => $validated['study_year'],
            'favorite_activity' => $validated['favorite_activity'],
            'interested_fields' => $validated['interested_fields'],
            'current_need' => $validated['current_need'],
            'join_workshop' => $validated['join_workshop'],
            'commitment_level' => $validated['commitment_level'],
            'career_goal' => $validated['career_goal'],
            'biggest_challenge' => $validated['biggest_challenge'],
            'career_awareness' => $validated['career_awareness'],
            'work_preference' => $validated['work_preference'],

            // AI fields
            'education' => $validated['education'],
            'specialization' => $validated['specialization'],
            'skills' => $validated['skills'],
            'certification' => $validated['certification'] ?? 'None',
            'cgpa' => $validated['cgpa'],
        ]);

        // 3. Send data to FastAPI AI service
        try {
            $aiResponse = Http::timeout(30)
                ->acceptJson()
                ->post('http://127.0.0.1:8001/predict', [
                    'education' => $validated['education'],
                    'specialization' => $validated['specialization'],
                    'skills' => $validated['skills'],
                    'certification' => $validated['certification'] ?? 'None',
                    'cgpa' => $validated['cgpa'],
                ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Could not connect to AI service.',
                'error' => $e->getMessage(),
            ], 503);
        }

        // 4. Check AI response
        if (!$aiResponse->successful()) {
            return response()->json([
                'status' => false,
                'message' => 'AI prediction failed.',
                'ai_response' => $aiResponse->json(),
            ], 422);
        }

        $aiResult = $aiResponse->json();

        // 5. Get AI prediction
        $aiCareer = $aiResult['predicted_career'];
        $confidence = (float) $aiResult['confidence'];

        // 6. Find career in Laravel database
        $careerMapping = [
            'ML Engineer' => 'AI Engineer',
            'Machine Learning Engineer' => 'AI Engineer',
            'Research Scientist' => 'AI Engineer',
            'Software Engineer' => 'Backend Developer',
            'Data Scientist' => 'Data Analyst',
        ];

        $careerName = $careerMapping[$aiCareer] ?? $aiCareer;

        $careerModel = Career::where('career_name', $careerName)->first();

        // 7. If career does not exist
        if (!$careerModel) {
            return response()->json([
                'status' => false,
                'message' => 'AI returned a career that does not exist in Laravel database.',
                'ai_career' => $aiCareer,
                'mapped_career' => $careerName,
            ], 422);
        }

        // 8. Save career prediction
        $prediction = CareerPrediction::create([
            'assessment_id' => $assessment->id,
            'career_id' => $careerModel->id,
            'predicted_career' => $careerName,
            'confidence_score' => $confidence * 100,
        ]);

        // 9. Save salary prediction
        $salary = SalaryPrediction::create([
            'career_prediction_id' => $prediction->id,
            'expected_salary' => $careerModel->expected_salary,
            'currency' => $careerModel->currency,
        ]);

        // 10. Get roadmap
        $roadmap = Roadmap::where('career_id', $careerModel->id)
            ->orderBy('step_number')
            ->get();

        // 11. Return final result
        return response()->json([
            'status' => true,
            'message' => 'Assessment Saved Successfully',
            'assessment_id' => $assessment->id,

            'career' => [
                'name' => $careerName,
                'ai_name' => $aiCareer,
                'confidence' => round($confidence * 100, 2),
            ],

            'top_3_careers' => $aiResult['top_3_careers'] ?? [],

            'salary' => [
                'expected_salary' => $salary->expected_salary,
                'currency' => $salary->currency,
            ],

            'roadmap' => $roadmap,
        ], 201);
    }

    /**
     * Get assessment history.
     */
    public function history()
    {
        $assessments = Assessment::latest()->get();

        return response()->json([
            'status' => true,
            'count' => $assessments->count(),
            'data' => $assessments,
        ]);
    }

    /**
     * Show one assessment.
     */
    public function show($id)
    {
        $assessment = Assessment::find($id);

        if (!$assessment) {
            return response()->json([
                'status' => false,
                'message' => 'Assessment not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $assessment,
        ]);
    }

    /**
     * Update assessment.
     */
    public function update(Request $request, $id)
    {
        $assessment = Assessment::find($id);

        if (!$assessment) {
            return response()->json([
                'status' => false,
                'message' => 'Assessment not found',
            ], 404);
        }

        $assessment->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Assessment updated successfully',
            'data' => $assessment,
        ]);
    }

    /**
     * Delete assessment.
     */
    public function destroy($id)
    {
        $assessment = Assessment::find($id);

        if (!$assessment) {
            return response()->json([
                'status' => false,
                'message' => 'Assessment not found',
            ], 404);
        }

        $assessment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Assessment deleted successfully',
        ]);
    }

    /**
     * Get complete result of an assessment.
     */
    public function result($assessmentId)
    {
        $assessment = Assessment::find($assessmentId);

        if (!$assessment) {
            return response()->json([
                'status' => false,
                'message' => 'Assessment not found',
            ], 404);
        }

        $prediction = CareerPrediction::where(
            'assessment_id',
            $assessment->id
        )->latest()->first();

        if (!$prediction) {
            return response()->json([
                'status' => false,
                'message' => 'Career prediction not found',
            ], 404);
        }

        $salary = SalaryPrediction::where(
            'career_prediction_id',
            $prediction->id
        )->first();

        $roadmap = Roadmap::where(
            'career_id',
            $prediction->career_id
        )
        ->orderBy('step_number')
        ->get();

        return response()->json([
            'status' => true,
            'assessment' => $assessment,

            'career' => [
                'name' => $prediction->predicted_career,
                'confidence' => $prediction->confidence_score,
            ],

            'salary' => [
                'expected_salary' => $salary?->expected_salary,
                'currency' => $salary?->currency,
            ],

            'roadmap' => $roadmap,
        ]);
    }
}