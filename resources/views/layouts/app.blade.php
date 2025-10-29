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

    
    <style>
        [x-cloak] {
            display: none !important;
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

        
        .loader {
            border-top-color: #3490dc;
            
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #loader {
            display: none;
        }

        #loader.active {
            display: flex;
        }

        
        .page-fade {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .fade-active {
            opacity: 1;
        }

        body {
            background-image: url('{{ asset('images/background.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;

        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen page-fade">

    
    <div id="loader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-16 w-16"></div>
    </div>

    
    @include('partials.navbar')

    
    <main class="pt-20">
        @yield('content')
    </main>

    
    @include('partials.footer')

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loader = document.getElementById('loader');

            
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

            
            document.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function (e) {
                    const href = link.getAttribute('href');
                    const isDownload = link.hasAttribute('download') || link.getAttribute('target') === '_blank';

                    if (href && !href.startsWith('#') && !isDownload) {
                        loader.classList.add('active');
                    }
                });
            });

            
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function () {
                    loader.classList.add('active');
                });
            });

            
            window.addEventListener('pageshow', function () {
                loader.classList.remove('active');
            });
        });
    </script>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

</body>

</html>