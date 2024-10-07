<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->user()->load('employer.jobs');
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   

        $request->user()->employer()->create([
            'company_name' => $request->company_name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Added company name success',
        ]);
    }

    public function createJob(Request $request) {

        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'employer_id' => $request->user()->employer->id ,
            'salary' => $request->salary,
            'location' => $request->location,
            'category' => $request->category,
            'experience' => $request->experience,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Added job cucessfully',
        ]);
    }

    public function deleteJob($id) {
        
        $data = Job::findOrFail($id);

        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Job delete successfully',
        ]);
    }

}
