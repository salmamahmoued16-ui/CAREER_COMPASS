<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssessmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/assessment', function () {
    return view('assessment');
});

Route::post('/assessment', [AssessmentController::class, 'store']);
