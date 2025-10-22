<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ $logo && $logo->image && file_exists(public_path('storage/' . $logo->image))
    ? asset('storage/' . $logo->image)
    : asset('images/logoPPS.png') }}">



    <title>@yield('title')</title>

    @vite('resources/css/app.css')
    <script defer src="//unpkg.com/alpinejs"></script>

    {{-- 🔹 Anti Flicker --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <style>
        .ck-content ul,
        .ck-content ul li {
            list-style-type: disc;
            margin-left: 1.25rem;
        }

        .ck-content ol,
        .ck-content ol li {
            list-style-type: decimal;
            margin-left: 1.25rem;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen page-fade">

    {{-- 🔹 Navbar --}}
    @include('partials.navbar')

    {{-- 🔹 Konten Halaman --}}
    <main class="pt-20">
        @yield('content')
    </main>

    {{-- 🔹 Footer --}}
    @include('partials.footer')

    {{-- 🔹 Script untuk Transisi Halaman --}}
    <script>
        const applyFade = () => {
            document.body.classList.remove("fade-active"); // Reset
            // Double requestAnimationFrame untuk memastikan transisi berjalan konsisten
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    document.body.classList.add("fade-active");
                });
            });
        };

        // Jalankan saat window load agar semua elemen sudah render
        window.addEventListener("load", applyFade);

        // Tangani Alpine.js re-init
        document.addEventListener("alpine:initialized", applyFade);
    </script>

</body>

</html>