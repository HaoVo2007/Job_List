<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('jobs.index');
});

Route::get('/login', function() {
    return view('login');
});

Route::get('/register', function() {
    return view('register');
});

Route::get('/create/employee', function() {
    return view('employer.index');
});

Route::get('/my-job', function() {
    return view('employer.my-job');
});

Route::get('/create/job', function() {
    return view('employer.create');
});

Route::get('/my-application', function() {
    return view('jobs.my-job-application');
});

Route::get('/job/detail/{id}', function ($id) {
    $job = Job::findOrFail($id);
    return view('jobs.show', ['job' => $job]);
});

Route::get('/job/{job}/applications', function ($job) {
    $job = Job::findOrFail($job);
    return view('jobs.job-application', ['job' => $job]);
});
