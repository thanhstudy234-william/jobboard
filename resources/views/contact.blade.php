<x-public-layout title="Liên hệ">
    <div class="max-w-xl mx-auto px-4 py-12">
        <div class="rounded-xl border border-slate-200 bg-white p-8 shadow-sm">
            <h1 class="text-2xl font-bold mb-1">Liên hệ với chúng tôi</h1>
            <p class="mb-6 text-sm text-slate-500">Để lại lời nhắn, chúng tôi sẽ phản hồi sớm.</p>

            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 p-3 text-green-800">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-100 p-3 text-red-800">
                    <ul class="list-disc ml-5">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-3">
                @csrf
                <input name="name" value="{{ old('name') }}" placeholder="Họ tên" class="w-full rounded-lg border-slate-300">
                <input name="email" type="email" value="{{ old('email') }}" placeholder="Email" class="w-full rounded-lg border-slate-300">
                <textarea name="message" rows="5" placeholder="Nội dung" class="w-full rounded-lg border-slate-300">{{ old('message') }}</textarea>
                <button class="w-full rounded-lg bg-indigo-600 py-2.5 font-semibold text-white hover:bg-indigo-700">Gửi liên hệ</button>
            </form>
        </div>
    </div>
</x-public-layout>