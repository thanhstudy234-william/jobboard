<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Hồ sơ ứng tuyển: {{ $job->title }}</h1>
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <table class="w-full text-left border table-fixed">
    <thead>
        <tr class="border-b">
            <th class="p-2 text-left w-1/5">Ứng viên</th>
            <th class="p-2 text-left w-1/4">Email</th>
            <th class="p-2 text-left w-1/6">CV</th>
            <th class="p-2 text-left">Trạng thái</th>
        </tr>
    </thead>
            <tbody>
                @forelse ($applications as $a)
                    <tr class="border-b">
                        <td class="p-2">{{ $a->candidate->name }}</td>
                        <td class="p-2">{{ $a->candidate->email }}</td>
                        <td class="p-2">
                            <a href="{{ asset('storage/'.$a->cv_file) }}" target="_blank" class="text-indigo-600">Tải CV</a>
                        </td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('employer.applicants.update', $a) }}" class="flex gap-2">
                                @csrf @method('PATCH')
                                <select name="status" class="border-gray-300 rounded-md">
                                    @foreach (['new','viewed','interview','rejected','accepted'] as $s)
                                        <option value="{{ $s }}" @selected($a->status == $s)>{{ $s }}</option>
                                    @endforeach
                                </select>
                                <button class="text-indigo-600">Lưu</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-4">Chưa có hồ sơ nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>