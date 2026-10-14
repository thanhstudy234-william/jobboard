<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\JobPost;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    // Lấy công ty của nhà tuyển dụng, chưa có thì tự tạo
    private function company(): Company
    {
        return Company::firstOrCreate(
            ['user_id' => auth()->id()],
            ['name' => 'Công ty của ' . auth()->user()->name]
        );
    }

    private function rules(): array
    {
        return [
            'title' => 'required|max:200',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'requirements' => 'nullable',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gte:salary_min',
            'location' => 'nullable|max:100',
            'job_type' => 'required|in:full-time,part-time,remote',
            'deadline' => 'nullable|date',
        ];
    }

    public function index()
    {
        $jobs = JobPost::where('company_id', $this->company()->id)
            ->withCount('applications')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('employer.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('employer.jobs.form', [
            'job' => new JobPost(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data['company_id'] = $this->company()->id;
        $data['status'] = 'pending'; // chờ admin duyệt
        JobPost::create($data);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Đã đăng tin, đang chờ admin duyệt.');
    }

    public function edit(JobPost $job)
    {
        $this->authorizeJob($job);
        return view('employer.jobs.form', [
            'job' => $job,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, JobPost $job)
    {
        $this->authorizeJob($job);
        $job->update($request->validate($this->rules()));

        return redirect()->route('employer.jobs.index')->with('success', 'Đã cập nhật tin.');
    }

    public function destroy(JobPost $job)
    {
        $this->authorizeJob($job);
        \App\Models\SavedJob::where('job_post_id', $job->id)->delete();
        $job->delete();

        return redirect()->route('employer.jobs.index')->with('success', 'Đã xóa tin.');
    }

    // Chặn sửa/xóa tin của công ty khác
    private function authorizeJob(JobPost $job): void
{
    abort_unless((int) $job->company_id === (int) $this->company()->id, 403);
}
}