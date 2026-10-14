<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Tin tuyển dụng của tôi</h1>
            <a href="{{ route('employer.jobs.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded-md">+ Đăng tin mới</a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <table class="w-full text-left border">
            <thead>
                <tr class="border-b">
                    <th class="p-2">Tiêu đề</th>
                    <th class="p-2">Trạng thái</th>
                    <th class="p-2">Hạn nộp</th>
                    <th class="p-2">Hồ sơ</th>
                    <th class="p-2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jobs as $job)
                    <tr class="border-b">
                        <td class="p-2">{{ $job->title }}</td>
                        <td class="p-2"><x-badge :status="$job->status" /></td>
                        <td class="p-2">{{ $job->deadline?->format('d/m/Y') }}</td>
                        <td class="p-2"><a href="{{ route('employer.applicants.index', $job) }}" class="text-indigo-600">{{ $job->applications_count }} hồ sơ</a></td>
                        <td class="p-2 flex gap-3">
                            <a href="{{ route('employer.jobs.edit', $job) }}" class="text-indigo-600">Sửa</a>
                            <form method="POST" action="{{ route('employer.jobs.destroy', $job) }}"
                                  onsubmit="return confirm('Xóa tin này?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-4">Bạn chưa đăng tin nào.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $jobs->links() }}</div>
    </div>
</x-app-layout>