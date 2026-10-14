<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Company;
use App\Models\JobPost;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    private function owns(JobPost $job): void
    {
        $company = Company::where('user_id', auth()->id())->first();
        abort_unless($company && (int) $job->company_id === (int) $company->id, 403);
    }

    public function index(JobPost $job)
    {
        $this->owns($job);
        $applications = $job->applications()->with('candidate')
            ->orderByDesc('created_at')->get();

        return view('employer.applicants', compact('job', 'applications'));
    }

    public function update(Request $request, Application $application)
    {
        $this->owns($application->jobPost);
        $data = $request->validate([
            'status' => 'required|in:new,viewed,interview,rejected,accepted',
        ]);
        $application->update($data);

        return back()->with('success', 'Đã cập nhật trạng thái.');
    }
}