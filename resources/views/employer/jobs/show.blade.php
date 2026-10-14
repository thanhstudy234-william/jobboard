<x-guest-layout>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg">
        <h1 class="text-2xl font-bold">{{ $job->title }}</h1>
        <p class="text-gray-600 mb-4">{{ $job->company->name }} · {{ $job->location }}</p>
        <h2 class="font-semibold mt-4">Mô tả công việc</h2>
        <p>{{ $job->description }}</p>
        <h2 class="font-semibold mt-4">Yêu cầu</h2>
        <p>{{ $job->requirements }}</p>
        <p class="mt-4 text-green-700">
            Mức lương: {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} VNĐ
        </p>
        <a href="{{ route('home') }}" class="inline-block mt-6 text-indigo-600">← Quay lại danh sách</a>
    @auth
    @if (auth()->user()->role === 'candidate')
        @if ($errors->any())
            <div class="mt-4 p-3 bg-red-100 text-red-800 rounded">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('jobs.apply', $job) }}" enctype="multipart/form-data" class="mt-6 space-y-3">
            @csrf
            <input type="file" name="cv_file" accept="application/pdf" required>
            <textarea name="cover_letter" rows="3" placeholder="Thư giới thiệu (không bắt buộc)"
                      class="w-full border-gray-300 rounded-md"></textarea>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-md">Ứng tuyển</button>
        </form>
        <form method="POST" action="{{ route('jobs.save', $job) }}" class="mt-2">
            @csrf
            <button class="text-indigo-600">Lưu / bỏ lưu việc làm</button>
        </form>
    @endif
@else
    <p class="mt-6"><a href="{{ route('login') }}" class="text-indigo-600">Đăng nhập</a> để ứng tuyển.</p>
@endauth
    </div>
</x-guest-layout>