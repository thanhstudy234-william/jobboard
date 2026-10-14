<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Xin chào, {{ auth()->user()->name }}</h1>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($stats as $label => $value)
                <div class="border rounded-lg p-5">
                    <div class="text-3xl font-bold">{{ $value }}</div>
                    <div class="text-gray-500 mt-1">{{ $label }}</div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>