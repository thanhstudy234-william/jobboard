@php
    $types = ['full-time' => 'Toàn thời gian', 'part-time' => 'Bán thời gian', 'remote' => 'Làm từ xa'];
@endphp
<x-public-layout title="Tìm việc làm">
    <section class="bg-gradient-to-br from-indigo-600 to-violet-600 text-white">
        <div class="max-w-6xl mx-auto px-4 py-14">
            <h1 class="text-3xl md:text-4xl font-bold">Tìm công việc mơ ước của bạn</h1>
            <p class="mt-2 text-indigo-100">{{ $jobs->total() }} việc làm đang tuyển</p>

            <form method="GET" class="mt-6 grid gap-2 rounded-xl bg-white p-3 shadow-lg md:grid-cols-[2fr_1fr_1fr_1fr_auto]">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Từ khóa, vị trí..."
                       class="rounded-lg border-slate-300 text-slate-800">
                <select name="category" class="rounded-lg border-slate-300 text-slate-800">
                    <option value="">Tất cả ngành</option>
                    @foreach ($categories as $c)
                        <option value="{{ $c->id }}" @selected(request('category') == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
                <select name="location" class="rounded-lg border-slate-300 text-slate-800">
                    <option value="">Địa điểm</option>
                    @foreach (['Hà Nội', 'TP. Hồ Chí Minh', 'Đà Nẵng'] as $l)
                        <option value="{{ $l }}" @selected(request('location') == $l)>{{ $l }}</option>
                    @endforeach
                </select>
                <select name="job_type" class="rounded-lg border-slate-300 text-slate-800">
                    <option value="">Loại hình</option>
                    @foreach ($types as $k => $v)
                        <option value="{{ $k }}" @selected(request('job_type') == $k)>{{ $v }}</option>
                    @endforeach
                </select>
                <button class="rounded-lg bg-indigo-600 px-6 py-2 font-semibold text-white hover:bg-indigo-700">Tìm kiếm</button>
            </form>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-4 py-10">
        <div class="grid gap-4 md:grid-cols-2">
            @forelse ($jobs as $job)
                <a href="{{ route('jobs.show', $job) }}"
                   class="flex gap-4 rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-indigo-300 hover:shadow-md">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-lg font-bold text-indigo-600">
                        {{ mb_strtoupper(mb_substr($job->company->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <h3 class="truncate text-lg font-semibold">{{ $job->title }}</h3>
                        <p class="text-sm text-slate-500">{{ $job->company->name }}</p>
                        <div class="mt-2 flex flex-wrap gap-2 text-xs">
                            <span class="rounded-full bg-slate-100 px-2.5 py-1">{{ $job->location }}</span>
                            <span class="rounded-full bg-slate-100 px-2.5 py-1">{{ $job->category->name }}</span>
                            <span class="rounded-full bg-indigo-50 px-2.5 py-1 text-indigo-700">{{ $types[$job->job_type] ?? $job->job_type }}</span>
                        </div>
                        <p class="mt-2 text-sm font-semibold text-emerald-600">
                            {{ number_format($job->salary_min / 1000000, 0) }} - {{ number_format($job->salary_max / 1000000, 0) }} triệu
                        </p>
                    </div>
                </a>
            @empty
                <p class="col-span-2 py-10 text-center text-slate-500">Không tìm thấy việc làm phù hợp.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $jobs->links() }}</div>
    </div>
</x-public-layout>