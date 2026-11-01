<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\SalaryPredictionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CareerPathController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SavedPostController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityQuestionController;
use App\Http\Controllers\CommunityAnswerController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\AiMentorController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\AppInfoController;
use App\Http\Controllers\ScheduleController;

Route::post('/assessment', [AssessmentController::class, 'store']);

Route::apiResource('careers', CareerController::class);

Route::get('/roadmap/{careerId}', [RoadmapController::class, 'index']);
Route::get('/salary/{careerId}', [SalaryPredictionController::class, 'index']);
Route::get('/assessments', [AssessmentController::class, 'history']);

Route::get('/assessment/{id}', [AssessmentController::class, 'show']);
Route::put('/assessment/{id}', [AssessmentController::class, 'update']);
Route::delete('/assessment/{id}', [AssessmentController::class, 'destroy']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);


Route::get('/home',[HomeController::class,'index']);
Route::get('/questions', [QuestionController::class, 'index']);
Route::get('/career-paths', [CareerPathController::class, 'index']);
Route::get('/career-paths/{id}', [CareerPathController::class, 'show']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendCode']);
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);
Route::get('/result/{assessmentId}', [AssessmentController::class, 'result']);

Route::apiResource('communities', CommunityController::class);
Route::middleware('auth:sanctum')->apiResource('posts', PostController::class);
Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);
Route::get('/comments/{id}', [CommentController::class, 'show']);
Route::put('/comments/{id}', [CommentController::class, 'update']);
Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
Route::get('/likes', [LikeController::class, 'index']);
Route::post('/likes', [LikeController::class, 'store']);
Route::get('/likes/{id}', [LikeController::class, 'show']);
Route::put('/likes/{id}', [LikeController::class, 'update']);
Route::delete('/likes/{id}', [LikeController::class, 'destroy']);
Route::get('/saved-posts', [SavedPostController::class, 'index']);
Route::post('/saved-posts', [SavedPostController::class, 'store']);
Route::get('/saved-posts/{id}', [SavedPostController::class, 'show']);
Route::put('/saved-posts/{id}', [SavedPostController::class, 'update']);
Route::delete('/saved-posts/{id}', [SavedPostController::class, 'destroy']);
Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications', [NotificationController::class, 'store']);
Route::get('/notifications/{id}', [NotificationController::class, 'show']);
Route::put('/notifications/{id}', [NotificationController::class, 'update']);
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
Route::get('/profile/{id}', [ProfileController::class, 'show']);
Route::put('/profile/{id}', [ProfileController::class, 'update']);
Route::middleware('auth:sanctum')->put('/profile', [AuthController::class, 'updateProfile']);
// Community Q&A
Route::get('/community/questions', [CommunityQuestionController::class, 'index']);
Route::post('/community/questions', [CommunityQuestionController::class, 'store']);
Route::get('/community/questions/{id}', [CommunityQuestionController::class, 'show']);
Route::delete('/community/questions/{id}', [CommunityQuestionController::class, 'destroy']);

Route::post('/community/answers', [CommunityAnswerController::class, 'store']);
Route::delete('/community/answers/{id}', [CommunityAnswerController::class, 'destroy']);
Route::get('/resources', [ResourceController::class, 'index']);
Route::post('/resources', [ResourceController::class, 'store']);
Route::get('/resources/{id}', [ResourceController::class, 'show']);
Route::put('/resources/{id}', [ResourceController::class, 'update']);
Route::delete('/resources/{id}', [ResourceController::class, 'destroy']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/ai-mentor/chat', [AiMentorController::class, 'chat']);
    Route::get('/ai-mentor/history', [AiMentorController::class, 'history']);

Route::middleware('auth:sanctum')->put(
    '/change-password',
    [AuthController::class, 'changePassword']
);

Route::post('/google-login', [AuthController::class, 'googleLogin']);
Route::post('/apple-login', [AuthController::class, 'appleLogin']);
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/settings', [SettingsController::class, 'show']);
    Route::put('/settings', [SettingsController::class, 'update']);

});

Route::post('/support', [SupportController::class, 'store']);
Route::get('/support', [SupportController::class, 'index']);
Route::get('/about', [AppInfoController::class, 'index']);
Route::get('/schedule', [ScheduleController::class, 'index']);
Route::post('/schedule', [ScheduleController::class, 'store']);
Route::put('/schedule/{id}', [ScheduleController::class, 'update']);
Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy']);




});

