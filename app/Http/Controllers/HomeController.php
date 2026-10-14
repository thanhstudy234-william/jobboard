<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobPost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $jobs = JobPost::with(['company', 'category'])
            ->where('status', 'approved')
            ->when($request->q, fn ($q, $v) => $q->where('title', 'like', "%$v%"))
            ->when($request->category, fn ($q, $v) => $q->where('category_id', $v))
            ->when($request->location, fn ($q, $v) => $q->where('location', $v))
            ->when($request->job_type, fn ($q, $v) => $q->where('job_type', $v))
            ->orderByDesc('created_at')
            ->paginate(6)
            ->withQueryString();

        return view('home', [
            'jobs' => $jobs,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function show(JobPost $job)
    {
        abort_unless($job->status === 'approved', 404);
        $job->load(['company', 'category']);
        return view('jobs.show', compact('job'));
    }
}