<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;

class JobApprovalController extends Controller
{
    public function index(Request $request)
    {
        $jobs = JobPost::with('company')
            ->when($request->status, fn ($q, $v) => $q->where('status', $v))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.jobs.index', compact('jobs'));
    }

    public function update(Request $request, JobPost $job)
    {
        $data = $request->validate(['status' => 'required|in:pending,approved,closed']);
        $job->update($data);

        return back()->with('success', 'Đã cập nhật trạng thái tin.');
    }
}