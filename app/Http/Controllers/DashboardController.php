<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Company;
use App\Models\Contact;
use App\Models\JobPost;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $stats = [];

        if ($user->role === 'admin') {
            $stats = [
                'Tổng người dùng' => User::count(),
                'Tin chờ duyệt' => JobPost::where('status', 'pending')->count(),
                'Tin đã duyệt' => JobPost::where('status', 'approved')->count(),
                'Tổng hồ sơ ứng tuyển' => Application::count(),
                'Liên hệ' => Contact::count(),
            ];
        } elseif ($user->role === 'employer') {
            $company = Company::where('user_id', $user->id)->first();
            $jobIds = $company ? JobPost::where('company_id', $company->id)->pluck('id') : collect();
            $stats = [
                'Tin đã đăng' => $jobIds->count(),
                'Hồ sơ nhận được' => Application::whereIn('job_post_id', $jobIds)->count(),
                'Hồ sơ mới' => Application::whereIn('job_post_id', $jobIds)->where('status', 'new')->count(),
                'Mời phỏng vấn' => Application::whereIn('job_post_id', $jobIds)->where('status', 'interview')->count(),
            ];
        } else {
            $stats = [
                'Đơn đã nộp' => Application::where('candidate_id', $user->id)->count(),
                'Đang phỏng vấn' => Application::where('candidate_id', $user->id)->where('status', 'interview')->count(),
                'Được nhận' => Application::where('candidate_id', $user->id)->where('status', 'accepted')->count(),
                'Việc đã lưu' => $user->savedJobs()->count(),
            ];
        }

        return view('dashboard', compact('stats'));
    }
}