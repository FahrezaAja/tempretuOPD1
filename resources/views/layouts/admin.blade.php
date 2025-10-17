<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logoPPS.png') }}">
    <title>@yield('title', 'Admin Panel')</title>

    @vite('resources/css/app.css')
    <script defer src="//unpkg.com/alpinejs"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Efek transisi halaman */
        .page-fade {
            opacity: 0;
            transition: opacity 0.4s ease-in-out;
        }

        .page-fade.fade-active {
            opacity: 1;
        }

        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen page-fade" x-data="{ sidebarOpen: false }">

    {{-- 🔹 Sidebar Tetap di Kiri --}}
    <aside class="fixed top-0 left-0 w-64 h-full bg-gray-800 text-gray-100 z-40 overflow-y-auto shadow-lg">
        @include('partials.sidebar')
    </aside>

    {{-- 🔹 Overlay untuk mobile --}}
    <div @click="sidebarOpen = false" :class="sidebarOpen ? 'block' : 'hidden'"
        class="fixed inset-0 bg-black opacity-50 z-30 lg:hidden"></div>

    {{-- 🔹 Konten utama --}}
    <main class="ml-64 flex-1 p-6 transition-all duration-300">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </main>

    <script>
        // Animasi transisi halaman
        const applyFade = () => {
            document.body.classList.remove("fade-active");
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