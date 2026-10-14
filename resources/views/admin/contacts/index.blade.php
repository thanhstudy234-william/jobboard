<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Liên hệ từ khách</h1>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <table class="w-full text-left border table-fixed">
            <thead>
                <tr class="border-b">
                    <th class="p-2 text-left w-1/6">Họ tên</th>
                    <th class="p-2 text-left w-1/5">Email</th>
                    <th class="p-2 text-left">Nội dung</th>
                    <th class="p-2 text-left w-28">Ngày gửi</th>
                    <th class="p-2 w-16"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $c)
                    <tr class="border-b align-top">
                        <td class="p-2">{{ $c->name }}</td>
                        <td class="p-2 break-words">{{ $c->email }}</td>
                        <td class="p-2 break-words">{{ $c->message }}</td>
                        <td class="p-2">{{ $c->created_at->format('d/m/Y') }}</td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('admin.contacts.destroy', $c) }}"
                                  onsubmit="return confirm('Xóa liên hệ này?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-4">Chưa có liên hệ nào.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $contacts->links() }}</div>
    </div>
</x-app-layout>