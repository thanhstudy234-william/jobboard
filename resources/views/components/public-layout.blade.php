<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <title>{{ $title ?? 'Việc làm' }} – JobBoard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">
    <header class="bg-white border-b border-slate-200 sticky top-0 z-10">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">Job<span class="text-slate-800">Board</span></a>
            <nav class="flex items-center gap-5 text-sm font-medium">
                <a href="{{ route('home') }}" class="hover:text-indigo-600">Việc làm</a>
                <a href="{{ route('contact') }}" class="hover:text-indigo-600">Liên hệ</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Bảng điều khiển</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-indigo-600">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Đăng ký</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="flex-1">{{ $slot }}</main>

    <footer class="border-t border-slate-200 bg-white py-6 text-center text-sm text-slate-500">
        © {{ date('Y') }} JobBoard – Đồ án Web
    </footer>
</body>
</html>