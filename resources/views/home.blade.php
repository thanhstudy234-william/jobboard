<x-guest-layout>
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Tìm việc làm</h1>
<div class="mb-4 text-sm">
    <a href="{{ route('contact') }}" class="text-indigo-600">Liên hệ</a> ·
    <a href="{{ route('login') }}" class="text-indigo-600">Đăng nhập</a> ·
    <a href="{{ route('register') }}" class="text-indigo-600">Đăng ký</a>
</div>
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-2 mb-6">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Từ khóa..."
                   class="border-gray-300 rounded-md md:col-span-2">
            <select name="category" class="border-gray-300 rounded-md">
                <option value="">Tất cả ngành</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}" @selected(request('category') == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
            <select name="location" class="border-gray-300 rounded-md">
                <option value="">Địa điểm</option>
                @foreach (['Hà Nội', 'TP. Hồ Chí Minh', 'Đà Nẵng'] as $l)
                    <option value="{{ $l }}" @selected(request('location') == $l)>{{ $l }}</option>
                @endforeach
            </select>
            <button class="bg-indigo-600 text-white rounded-md px-4 py-2">Tìm kiếm</button>
        </form>

        @forelse ($jobs as $job)
            <a href="{{ route('jobs.show', $job) }}" class="block bg-white border rounded-lg p-4 mb-3 hover:shadow">
                <div class="font-semibold text-lg">{{ $job->title }}</div>
                <div class="text-gray-600">{{ $job->company->name }} · {{ $job->location }} · {{ $job->category->name }}</div>
                <div class="text-sm text-green-700 mt-1">
                    {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} VNĐ
                </div>
            </a>
        @empty
            <p>Không tìm thấy việc làm phù hợp.</p>
        @endforelse

        <div class="mt-4">{{ $jobs->links() }}</div>
    </div>
</x-guest-layout>