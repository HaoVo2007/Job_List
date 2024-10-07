<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\PersonalAccessToken;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Job::with('employer');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('employer.company_name', 'like', '%' . $request->search . '%')
                ->orWhereHas('employer', function($q) use ($request) {
                    $q->where('company_name', 'like', '%' . $request->search . '%');
                });
        }
        
        if ($request->from_salary && $request->to_salary) {
            $query->whereBetween('salary', [$request->from_salary, $request->to_salary]);
        } else if ($request->from_salary) {
            $query->where('salary', '>=', $request->from_salary);
        } else if ($request->to_salary) {
            $query->where('salary', '<=', $request->to_salary);
        }

        if ($request->experience) {
            $query->where('experience', $request->experience);
        }

        if ($request->category) {
            $query->where('category', $request->category);
        }

        $data = $query->get();

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
    public function show(Request $request, string $id)
    {
        $token = $request->bearerToken();
 
        $data = Job::with('employer.jobs')->findOrFail($id);

        if ($token != "null") {
            $user = PersonalAccessToken::findToken($token)->tokenable;
            if ($user) {
                $canApply = Gate::forUser($user)->allows('apply', $data);
                if ($canApply == false) {
                    $message = "You have applied for this job.";
                } else {
                    $message = "";
                }
            }
        } else {
            $canApply = false;
            $message = "Login to apply";
        }

        return response()->json([
            'data' => $data,
            'can_apply' => $canApply,
            'message' => $message,
        ]);
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
