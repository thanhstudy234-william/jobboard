<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Đơn ứng tuyển của tôi</h1>
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <table class="w-full text-left border">
            <thead><tr class="border-b">
                <th class="p-2">Việc làm</th><th class="p-2">Công ty</th>
                <th class="p-2">Trạng thái</th><th class="p-2">Ngày nộp</th>
            </tr></thead>
            <tbody>
                @forelse ($applications as $a)
                    <tr class="border-b">
                        <td class="p-2">{{ $a->jobPost->title }}</td>
                        <td class="p-2">{{ $a->jobPost->company->name }}</td>
                        <td class="p-2">{{ $a->status }}</td>
                        <td class="p-2">{{ $a->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-4">Bạn chưa nộp đơn nào.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $applications->links() }}</div>
    </div>
</x-app-layout>