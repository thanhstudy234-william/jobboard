<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $job->exists ? 'Sửa tin' : 'Đăng tin mới' }}</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ $job->exists ? route('employer.jobs.update', $job) : route('employer.jobs.store') }}"
              class="space-y-3">
            @csrf
            @if ($job->exists) @method('PUT') @endif

            <input name="title" value="{{ old('title', $job->title) }}" placeholder="Tiêu đề"
                   class="w-full border-gray-300 rounded-md">

            <select name="category_id" class="w-full border-gray-300 rounded-md">
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}" @selected(old('category_id', $job->category_id) == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>

            <textarea name="description" rows="5" placeholder="Mô tả công việc"
                      class="w-full border-gray-300 rounded-md">{{ old('description', $job->description) }}</textarea>
            <textarea name="requirements" rows="4" placeholder="Yêu cầu"
                      class="w-full border-gray-300 rounded-md">{{ old('requirements', $job->requirements) }}</textarea>

            <div class="grid grid-cols-2 gap-3">
                <input name="salary_min" type="number" value="{{ old('salary_min', $job->salary_min) }}"
                       placeholder="Lương tối thiểu" class="border-gray-300 rounded-md">
                <input name="salary_max" type="number" value="{{ old('salary_max', $job->salary_max) }}"
                       placeholder="Lương tối đa" class="border-gray-300 rounded-md">
            </div>

            <div class="grid grid-cols-3 gap-3">
                <input name="location" value="{{ old('location', $job->location) }}" placeholder="Địa điểm"
                       class="border-gray-300 rounded-md">
                <select name="job_type" class="border-gray-300 rounded-md">
                    @foreach (['full-time', 'part-time', 'remote'] as $t)
                        <option value="{{ $t }}" @selected(old('job_type', $job->job_type) == $t)>{{ $t }}</option>
                    @endforeach
                </select>
                <input name="deadline" type="date"
                       value="{{ old('deadline', optional($job->deadline)->format('Y-m-d')) }}"
                       class="border-gray-300 rounded-md">
            </div>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded-md">Lưu</button>
            <a href="{{ route('employer.jobs.index') }}" class="ml-3 text-gray-600">Hủy</a>
        </form>
    </div>
</x-app-layout>