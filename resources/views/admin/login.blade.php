<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-50 font-poppins min-h-screen flex items-center justify-center p-4"
    style="background-image: url('{{ url('images/backgroundlogin.jpg') }}'); 
             background-size: cover; 
             background-position: center; 
             background-repeat: no-repeat;">

    <div
        class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-2xl overflow-hidden shadow-xl transition-all duration-500 hover:shadow-2xl">

        <!-- Bagian Kiri - Gambar -->
        <div class="md:w-1/2 bg-green-50 p-8 flex justify-center items-center relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute top-0 left-0 w-full h-full opacity-20">
                <div class="absolute top-10 left-10 w-20 h-20 rounded-full bg-green-100"></div>
                <div class="absolute bottom-10 right-10 w-32 h-32 rounded-full bg-green-100"></div>
                <div class="absolute top-1/3 right-1/4 w-16 h-16 rounded-full bg-green-100"></div>
            </div>

            <div class="relative z-10 text-center">
                <img src="{{ asset('images/logopertanian.png') }}" alt="Illustration" class="w-4/5 mx-auto floating">
                <h1 class="text-xl font-semibold text-green-800 mt-6">Sistem Admin Lingkungan Hidup</h1>
                <p class="text-green-600 mt-2 text-sm">Kelola data dengan mudah</p>
            </div>
        </div>

        <!-- Bagian Kanan - Form Login -->
        <div class="md:w-1/2 p-8 md:p-10 flex flex-col justify-center">
            <div class="text-center md:text-left mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Selamat Datang Admin</h2>
                <p class="text-gray-600 mt-2">Silakan masuk ke akun Anda</p>
            </div>

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" name="username" placeholder="Masukkan username"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 outline-none"
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
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" id="password" placeholder="Masukkan password"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 outline-none"
                            required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" id="togglePassword"
                                class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-md hover:shadow-lg">
                    Login
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">
                    &copy; {{ date('Y') }} KOMINFO Papua Selatan. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <!-- Animasi CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translate(0, 0px);
            }

            50% {
                transform: translate(0, 10px);
            }

            100% {
                transform: translate(0, -0px);
            }
        }

        input:focus {
            box-shadow: 0 0 0 3px rgba(72, 187, 120, 0.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle password visibility
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

            // Efek interaktif pada form
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function () {
                    this.parentElement.classList.add('ring-2', 'ring-green-200');
                });
                input.addEventListener('blur', function () {
                    this.parentElement.classList.remove('ring-2', 'ring-green-200');
                });
            });

            // === SweetAlert2 Popup Handling ===
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#22c55e'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    html: '{!! implode("<br>", $errors->all()) !!}',
                    confirmButtonColor: '#22c55e'
                });
            @endif

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#22c55e'
                });
            @endif
        });
    </script>
</body>

</html>
