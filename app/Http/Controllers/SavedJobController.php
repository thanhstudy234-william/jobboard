<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;

class SavedJobController extends Controller
{
    public function index()
    {
        $jobs = auth()->user()->savedJobs()->with('company')->get();
        return view('candidate.saved', compact('jobs'));
    }

    public function toggle(JobPost $job)
    {
        auth()->user()->savedJobs()->toggle($job->id);
        return back();
    }
}