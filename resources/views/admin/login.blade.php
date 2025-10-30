<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-indigo-50 font-poppins min-h-screen flex items-center justify-center p-4"
    style="background-image: linear-gradient(to bottom right, rgba(67,56,202,0.1), rgba(165,180,252,0.2));">

    <div
        class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-3xl overflow-hidden shadow-2xl transition-all duration-500 hover:shadow-indigo-300">


        <div class="md:w-1/2 bg-indigo-600 p-10 flex justify-center items-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-20">
                <div class="absolute top-10 left-10 w-24 h-24 rounded-full bg-indigo-400"></div>
                <div class="absolute bottom-10 right-10 w-32 h-32 rounded-full bg-indigo-400"></div>
                <div class="absolute top-1/3 right-1/4 w-16 h-16 rounded-full bg-indigo-400"></div>
            </div>

            <div class="relative z-10 text-center text-white">
                <img src="{{ $logo && $logo->image && file_exists(public_path('storage/' . $logo->image))
    ? asset('storage/' . $logo->image)
    : asset('images/logoPPS.png') }}" alt="{{ $sampul->nama_instansi ?? 'Logo Instansi' }}"
                    class="w-4/5 mx-auto floating drop-shadow-lg">
            </div>
        </div>


        <div class="md:w-1/2 p-8 md:p-10 flex flex-col justify-center bg-white">
            <div class="text-center md:text-left mb-6">
                <h2 class="text-3xl font-bold text-indigo-700">Selamat Datang Admin</h2>
                <p class="text-gray-600 mt-2">Silakan masuk untuk melanjutkan</p>
            </div>

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-indigo-400"></i>
                        </div>
                        <input type="text" name="username" placeholder="Masukkan username"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 outline-none"
                            required value="{{ old('username') }}">
                    </div>
                    @error('username')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-indigo-400"></i>
                        </div>
                        <input type="password" name="password" id="password" placeholder="Masukkan password"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 outline-none"
                            required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" id="togglePassword"
                                class="text-gray-400 hover:text-indigo-600 focus:outline-none">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>


                <button type="submit"
                    class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-md hover:shadow-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Kominfo Papua Selatan. All rights reserved.
                </p>
            </div>
        </div>
    </div>


    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        @keyframes floating {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }
    </style>

    {{-- Script interaktif --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function () {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    const icon = this.querySelector('i');
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                });
            }

            // SweetAlert2 Handling
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#4f46e5'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    html: '{!! implode("<br>", $errors->all()) !!}',
                    confirmButtonColor: '#4f46e5'
                });
            @endif

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#4f46e5'
                });
            @endif
        });
    </script>
</body>

</html>