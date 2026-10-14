<x-guest-layout>
    <div class="max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Liên hệ</h1>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" class="space-y-3">
            @csrf
            <input name="name" value="{{ old('name') }}" placeholder="Họ tên"
                   class="w-full border-gray-300 rounded-md">
            <input name="email" type="email" value="{{ old('email') }}" placeholder="Email"
                   class="w-full border-gray-300 rounded-md">
            <textarea name="message" rows="5" placeholder="Nội dung"
                      class="w-full border-gray-300 rounded-md">{{ old('message') }}</textarea>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-md">Gửi liên hệ</button>
            <a href="{{ route('home') }}" class="ml-3 text-gray-600">← Trang chủ</a>
        </form>
    </div>
</x-guest-layout>