<?php

use App\Http\Controllers\Api\EmployerController;
use App\Http\Controllers\Api\JobApplicationController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyJobApplycation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('jobs', [JobController::class, 'index']);
Route::get('jobs/{job}', [JobController::class, 'show']);
Route::middleware('auth:sanctum')->group(function() {
    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout']);
    // GET USER
    Route::get('/get/user', [AuthController::class, 'getUser']);
    // JOBS
    Route::post('jobs', [JobController::class, 'store']);
    Route::put('jobs/{job}', [JobController::class, 'update']);
    Route::delete('jobs/{job}', [JobController::class, 'destroy']);
    //JOB-APPLICATION
    Route::post('jobs/{jobs}/applications', [JobApplicationController::class, 'store']);
    //JOB-MY-APPLICATION
    Route::get('my-applications', [MyJobApplycation::class, 'index']);
    Route::delete('my-applications/{application}', [MyJobApplycation::class, 'destroy']);
    //EMPLOYER-JOB
    Route::get('employer-job', [EmployerController::class, 'index']);
    Route::post('employer-job', [EmployerController::class, 'store']);
    Route::post('create-job', [EmployerController::class, 'createJob']);
    Route::delete('delete-job/{id}', [EmployerController::class, 'deleteJob']);

});
