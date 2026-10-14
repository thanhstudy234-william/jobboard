<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPost;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('jobPost.company')
            ->where('candidate_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('candidate.applications', compact('applications'));
    }

    public function store(Request $request, JobPost $job)
    {
        abort_unless($job->status === 'approved', 404);

        $data = $request->validate([
            'cv_file' => 'required|file|mimes:pdf|max:2048',
            'cover_letter' => 'nullable|max:2000',
        ]);

        if (Application::where('job_post_id', $job->id)
            ->where('candidate_id', auth()->id())->exists()) {
            return back()->withErrors('Bạn đã ứng tuyển tin này rồi.');
        }

        Application::create([
            'job_post_id' => $job->id,
            'candidate_id' => auth()->id(),
            'cv_file' => $request->file('cv_file')->store('cvs', 'public'),
            'cover_letter' => $data['cover_letter'] ?? null,
        ]);

        return redirect()->route('candidate.applications')
            ->with('success', 'Nộp đơn thành công.');
    }
}