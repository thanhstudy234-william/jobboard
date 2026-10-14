<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Danh mục ngành nghề</h1>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.categories.store') }}" class="flex gap-2 mb-6">
            @csrf
            <input name="name" placeholder="Tên danh mục mới" class="flex-1 border-gray-300 rounded-md">
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-md">Thêm</button>
        </form>

        @foreach ($categories as $c)
            <div class="flex items-center gap-3 border-b py-2">
                <form method="POST" action="{{ route('admin.categories.update', $c) }}" class="flex gap-2 flex-1">
                    @csrf @method('PUT')
                    <input name="name" value="{{ $c->name }}" class="flex-1 border-gray-300 rounded-md">
                    <button class="text-indigo-600">Sửa</button>
                </form>
                <span class="text-sm text-gray-500">{{ $c->job_posts_count }} tin</span>
                <form method="POST" action="{{ route('admin.categories.destroy', $c) }}"
                      onsubmit="return confirm('Xóa danh mục này?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Xóa</button>
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>