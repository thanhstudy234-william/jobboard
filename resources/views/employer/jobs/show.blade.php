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
    </div>
</x-guest-layout>