<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class MyJobApplycation extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->user()->jobApplications()->with(['job' => function($query) {
            $query->withCount('jobApplications')
                  ->withAvg('jobApplications', 'expected_salary');
        }, 'job.employer'])->latest()->get();
        

        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $data = JobApplication::findOrFail($id);

        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Delete my job application cuccessfully.'
        ]);
    }
}
