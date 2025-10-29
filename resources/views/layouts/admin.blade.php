<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ $logo && $logo->image && file_exists(public_path('storage/' . $logo->image))
    ? asset('storage/' . $logo->image)
    : asset('images/logoPPS.png') }}">
    <title>@yield('title', 'Admin Panel')</title>

    @vite('resources/css/app.css')
    <script defer src="//unpkg.com/alpinejs"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        
        .page-fade {
            opacity: 0;
            transition: opacity 0.4s ease-in-out;
        }

        .page-fade.fade-active {
            opacity: 1;
        }

        body {
            overflow-x: hidden;
            background-image: url('{{ asset('images/background.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

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

<body class="bg-gray-50 min-h-screen page-fade" x-data="{ sidebarOpen: false }">

    
    <aside class="fixed top-0 left-0 w-64 h-full bg-gray-800 text-gray-100 z-40 overflow-y-auto shadow-lg">
        @include('partials.sidebar')
    </aside>

    
    <div @click="sidebarOpen = false" :class="sidebarOpen ? 'block' : 'hidden'"
        class="fixed inset-0 bg-black opacity-50 z-30 lg:hidden"></div>

    
    <main class="ml-64 flex-1 p-6 transition-all duration-300">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </main>

    <script>
        
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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
</body>

</html>