<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kas Digital - Selamat Datang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-[#D65A5A] min-h-screen flex items-center justify-start p-10 md:p-20">

    <div class="max-w-[90%] w-full grid grid-cols-1 md:grid-cols-2 gap-24 lg:gap-40 items-center mx-auto">
        
        <div class="text-left">
            <h1 class="text-6xl md:text-8xl font-bold mb-4 leading-tight text-white">
                Selamat Datang
            </h1>
            <p class="text-2xl md:text-3xl font-light mb-10 text-white opacity-90">
                Kas digital membantu Anda mengelola keuangan kelas secara profesional, aman, mudah,
                efisien, dan mudah diakses kapan saja.
            </p>
            <div class="flex gap-4">
    @if (Route::has('login'))
        @auth
            <a href="{{ url('/dashboard') }}" class="bg-[#a03e40] text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-red-900/20 hover:scale-105 transition-all">
                Buka Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="bg-[#a03e40] text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-red-900/20 hover:scale-105 transition-all">
                Masuk
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-white text-[#a03e40] border-2 border-[#a03e40] px-8 py-3 rounded-xl font-bold hover:bg-red-50 transition-all">
                    Daftar Akun
                </a>
            @endif
        @endauth
    @endif
</div>
        </div>

        <div class="hidden md:flex justify-end">
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/online-payment-4268311-3551717.png" 
                alt="Fintech Illustration" 
                class="w-full max-w-xl drop-shadow-2xl transition duration-500 hover:scale-110">
        </div>
    </div>

</body>
</html>