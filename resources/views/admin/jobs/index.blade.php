<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Duyệt tin tuyển dụng</h1>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <form method="GET" class="mb-4">
            <select name="status" onchange="this.form.submit()" class="border-gray-300 rounded-md">
                <option value="">Tất cả trạng thái</option>
                @foreach (['pending', 'approved', 'closed'] as $s)
                    <option value="{{ $s }}" @selected(request('status') == $s)>{{ $s }}</option>
                @endforeach
            </select>
        </form>

        <table class="w-full text-left border">
            <thead>
                <tr class="border-b">
                    <th class="p-2">Tiêu đề</th>
                    <th class="p-2">Công ty</th>
                    <th class="p-2">Trạng thái</th>
                    <th class="p-2">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr class="border-b">
                        <td class="p-2">{{ $job->title }}</td>
                        <td class="p-2">{{ $job->company->name }}</td>
                        <td class="p-2">{{ $job->status }}</td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('admin.jobs.update', $job) }}" class="flex gap-2">
                                @csrf @method('PATCH')
                                <select name="status" class="border-gray-300 rounded-md">
                                    @foreach (['pending', 'approved', 'closed'] as $s)
                                        <option value="{{ $s }}" @selected($job->status == $s)>{{ $s }}</option>
                                    @endforeach
                                </select>
                                <button class="text-indigo-600">Lưu</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $jobs->links() }}</div>
    </div>
</x-app-layout>