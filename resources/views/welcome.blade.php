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
            <p class="text-lg font-medium opacity-90 mb-2 uppercase tracking-widest text-white">
                Projek Akhir SIJA
            </p>
            <h1 class="text-6xl md:text-8xl font-bold mb-4 leading-tight text-white">
                Selamat Datang
            </h1>
            <p class="text-2xl md:text-3xl font-light mb-10 text-white opacity-90">
                Kelola Kas Kelas Digital dengan Mudah.
            </p>
            
            <div class="flex flex-wrap gap-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-[#22C55E] hover:bg-green-600 text-white px-10 py-4 rounded-xl text-xl font-bold transition transform hover:scale-105 shadow-xl">
                            Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="bg-[#22C55E] hover:bg-green-600 text-white px-12 py-4 rounded-xl text-xl font-bold transition transform hover:scale-105 shadow-xl">
                            Register
                        </a>
                        <a href="{{ route('login') }}" class="border-2 border-white text-white px-12 py-4 rounded-xl text-xl font-bold hover:bg-white hover:text-[#D65A5A] transition shadow-lg">
                            Login
                        </a>
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