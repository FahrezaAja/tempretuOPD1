<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-indigo-50 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md text-center">
    <h2 class="text-2xl font-bold text-indigo-700 mb-4">Verifikasi OTP</h2>
    <p class="text-gray-600 mb-6">Masukkan kode OTP yang telah dikirim ke email Anda.</p>

    @if ($errors->any())
        <div class="text-red-500 mb-4">{{ implode(', ', $errors->all()) }}</div>
    @endif

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.otp.verify') }}" method="POST" class="space-y-4">
        @csrf
        <input type="text" name="otp" maxlength="6" pattern="\d{6}" inputmode="numeric"
               class="w-full border rounded-lg p-3 text-center tracking-widest text-xl" placeholder="••••••" required>
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg p-3 transition">
            Verifikasi OTP
        </button>
    </form>

    <form action="{{ route('admin.otp.resend') }}" method="POST" class="mt-4">
        @csrf
        <button id="resendButton" type="submit" class="text-indigo-600 hover:text-indigo-800 font-semibold" disabled>
            Kirim Ulang OTP (10)
        </button>
    </form>
</div>

<script>
    
    (function() {
        let countdown = 10;
        const button = document.getElementById('resendButton');

        
        button.disabled = true;
        button.innerText = `Kirim Ulang OTP (${countdown})`;

        const timer = setInterval(() => {
            countdown--;
            if (countdown > 0) {
                button.innerText = `Kirim Ulang OTP (${countdown})`;
            } else {
                button.disabled = false;
                button.innerText = 'Kirim Ulang OTP';
                clearInterval(timer);
            }
        }, 1000);
    })();
</script>

</body>
</html>
