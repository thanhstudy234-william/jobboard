<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Quản lý người dùng</h1>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <table class="w-full text-left border">
            <thead>
                <tr class="border-b">
                    <th class="p-2">Tên</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Vai trò</th>
                    <th class="p-2">Trạng thái</th>
                    <th class="p-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                    <tr class="border-b">
                        <td class="p-2">{{ $u->name }}</td>
                        <td class="p-2">{{ $u->email }}</td>
                        <td class="p-2">{{ $u->role }}</td>
                        <td class="p-2">{{ $u->status ? 'Hoạt động' : 'Đã khóa' }}</td>
                        <td class="p-2">
                            @if ($u->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.toggle', $u) }}">
                                    @csrf @method('PATCH')
                                    <button class="text-indigo-600">{{ $u->status ? 'Khóa' : 'Mở khóa' }}</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $users->links() }}</div>
    </div>
</x-app-layout>