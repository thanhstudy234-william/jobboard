@php
    $types = ['full-time' => 'Toàn thời gian', 'part-time' => 'Bán thời gian', 'remote' => 'Làm từ xa'];
@endphp
<x-public-layout :title="$job->title">
    <div class="max-w-6xl mx-auto px-4 py-10">
        <a href="{{ route('home') }}" class="text-sm text-indigo-600 hover:underline">← Quay lại danh sách</a>

        <div class="mt-4 grid gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h1 class="text-2xl font-bold">{{ $job->title }}</h1>
                    <p class="mt-1 text-slate-500">{{ $job->company->name }} · {{ $job->location }}</p>

                    <h2 class="mt-6 font-semibold text-lg">Mô tả công việc</h2>
                    <p class="mt-2 whitespace-pre-line text-slate-700">{{ $job->description }}</p>

                    <h2 class="mt-6 font-semibold text-lg">Yêu cầu ứng viên</h2>
                    <p class="mt-2 whitespace-pre-line text-slate-700">{{ $job->requirements }}</p>
                </div>
            </div>

            <aside class="space-y-4">
                <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm text-slate-500">Mức lương</p>
                    <p class="text-xl font-bold text-emerald-600">
                        {{ number_format($job->salary_min / 1000000, 0) }} - {{ number_format($job->salary_max / 1000000, 0) }} triệu
                    </p>
                    <dl class="mt-4 space-y-2 text-sm">
                        <div class="flex justify-between"><dt class="text-slate-500">Ngành</dt><dd>{{ $job->category->name }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Loại hình</dt><dd>{{ $types[$job->job_type] ?? $job->job_type }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Hạn nộp</dt><dd>{{ $job->deadline?->format('d/m/Y') }}</dd></div>
                    </dl>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                    @auth
                        @if (auth()->user()->role === 'candidate')
                            @if (session('success'))
                                <div class="mb-3 rounded-lg bg-green-100 p-3 text-sm text-green-800">{{ session('success') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="mb-3 rounded-lg bg-red-100 p-3 text-sm text-red-800">{{ $errors->first() }}</div>
                            @endif

                            <h3 class="mb-3 font-semibold">Ứng tuyển ngay</h3>
                            <form method="POST" action="{{ route('jobs.apply', $job) }}" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                <input type="file" name="cv_file" accept="application/pdf" required class="block w-full text-sm">
                                <textarea name="cover_letter" rows="3" placeholder="Thư giới thiệu (không bắt buộc)"
                                          class="w-full rounded-lg border-slate-300 text-sm"></textarea>
                                <button class="w-full rounded-lg bg-indigo-600 py-2 font-semibold text-white hover:bg-indigo-700">Ứng tuyển</button>
                            </form>
                            <form method="POST" action="{{ route('jobs.save', $job) }}" class="mt-2">
                                @csrf
                                <button class="w-full rounded-lg border border-slate-300 py-2 text-sm hover:bg-slate-50">Lưu / bỏ lưu việc làm</button>
                            </form>
                        @else
                            <p class="text-sm text-slate-500">Chỉ tài khoản ứng viên mới nộp đơn được.</p>
                        @endif
                    @else
                        <p class="text-sm text-slate-600">
                            <a href="{{ route('login') }}" class="font-semibold text-indigo-600">Đăng nhập</a> để ứng tuyển.
                        </p>
                    @endauth
                </div>
            </aside>
        </div>
    </div>
</x-public-layout>