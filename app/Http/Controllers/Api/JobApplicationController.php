<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Job $jobs)
    {
        $request->validate([
            'expected_salary' => 'required|min:1|max:10000',
            'cv' => 'required|file|mimes:pdf|max:10000',
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs', 'private');
    
        try {
            Gate::authorize('apply', $jobs);
        } catch (AuthorizationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your application already exists',
            ], 403);
        }

        if(!$jobs) {
            return response()->json([
                'status' => 'error',
                'message' => 'Job Not Found',
            ]);
        }

        JobApplication::create([
            'user_id' => $request->user()->id,
            'job_id' => $jobs->id,
            'expected_salary' => $request->expected_salary,
            'cv-path' => $path,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Apply Job Successfully', 
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
