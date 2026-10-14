<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Việc làm đã lưu</h1>
        @forelse ($jobs as $job)
            <a href="{{ route('jobs.show', $job) }}" class="block border rounded p-3 mb-2">
                <div class="font-semibold">{{ $job->title }}</div>
                <div class="text-gray-500">{{ $job->company->name }} · {{ $job->location }}</div>
            </a>
        @empty
            <p>Chưa lưu việc làm nào.</p>
        @endforelse
    </div>
</x-app-layout>