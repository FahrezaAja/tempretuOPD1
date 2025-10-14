<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logoPPS.png') }}">
    <title>@yield('title', 'Admin Panel')</title>

    @vite('resources/css/app.css')
    <script defer src="//unpkg.com/alpinejs"></script>

    {{-- 🔹 Anti Flicker --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen page-fade" x-data="{ sidebarOpen: false }">

    {{-- 🔹 Sidebar --}}
    <div class="flex">
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
             class="fixed z-30 inset-y-0 left-0 w-64 bg-gray-800 text-gray-100 transform transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-0">
            @include('partials.sidebar')
        </div>

        {{-- Overlay untuk mobile --}}
        <div @click="sidebarOpen = false"
             :class="sidebarOpen ? 'block' : 'hidden'"
             class="fixed inset-0 bg-black opacity-50 z-20 lg:hidden"></div>

        {{-- 🔹 Konten Halaman --}}
        <main class="flex-1 p-6 ml-64">
            @yield('content')
        </main>
    </div>

    {{-- 🔹 Script untuk Transisi Halaman --}}
    <script>
        const applyFade = () => {
            document.body.classList.remove("fade-active"); // Reset
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    document.body.classList.add("fade-active");
                });
            });
        };

        window.addEventListener("load", applyFade);
        document.addEventListener("alpine:initialized", applyFade);
    </script>

</body>

</html>
