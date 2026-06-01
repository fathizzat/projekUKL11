<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kas Digital - Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus_Jakarta_Sans', 'Plus Jakarta Sans', sans-serif;
        }
        
        .grid-mask {
            mask-image: radial-gradient(circle at center, white 10%, transparent 75%);
            -webkit-mask-image: radial-gradient(circle at center, white 10%, transparent 75%);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between relative overflow-hidden">

    <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden">
        <svg class="absolute inset-x-0 inset-y-[-10%] h-[120%] w-full fill-slate-300/30 stroke-slate-300/50 skew-y-3 grid-mask" aria-hidden="true">
            <defs>
                <pattern id="grid-pattern-ukl" width="35" height="35" patternUnits="userSpaceOnUse" x="-1" y="-1">
                    <path d="M.5 35V.5H35" fill="none" stroke-dasharray="0" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" stroke-width="0" fill="url(#grid-pattern-ukl)" />
            
            <svg x="-1" y="-1" class="overflow-visible fill-slate-200/60 dark:fill-slate-700/10">
                <rect stroke-width="0" width="34" height="34" x="141" y="141" />
                <rect stroke-width="0" width="34" height="34" x="246" y="71" />
                <rect stroke-width="0" width="34" height="34" x="421" y="211" />
                <rect stroke-width="0" width="34" height="34" x="596" y="106" />
                <rect stroke-width="0" width="34" height="34" x="771" y="281" />
                <rect stroke-width="0" width="34" height="34" x="946" y="141" />
            </svg>
        </svg>

        <div class="absolute top-1/4 left-1/2 -z-10 h-80 w-80 -translate-x-1/2 rounded-full bg-red-200/20 blur-[130px]"></div>
    </div>

    <header class="w-full px-8 md:px-16 py-6 flex justify-between items-center z-10 bg-white/60 backdrop-blur-md border-b border-slate-200/50">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[#a03e40] font-bold text-2xl">account_balance_wallet</span>
            <span class="text-lg font-extrabold tracking-tight text-slate-900">Kas<span class="text-[#a03e40]">Digital.</span></span>
        </div>
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-[#a03e40] text-white hover:bg-[#893537] shadow-lg shadow-red-900/10 transition-all">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-[#a03e40] mr-6 transition-colors">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-[#a03e40] text-white hover:bg-[#893537] shadow-lg shadow-red-900/10 transition-all">Registrasi</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>

    <main class="w-full flex-1 flex flex-col items-center justify-center text-center px-6 z-10 max-w-4xl mx-auto py-12">
        

        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-slate-950 leading-tight">
            Kelola Keuangan Kelas <br>
            <span class="bg-gradient-to-r from-[#a03e40] to-red-500 bg-clip-text text-transparent">
                Lebih Praktis & Transparan
            </span>
        </h1>

        <p class="max-w-2xl mx-auto text-base md:text-lg text-slate-600 font-medium mt-6 leading-relaxed">
            Pantau iuran mingguan, cek rekapitulasi pengeluaran, dan simpan riwayat transaksi kelas secara realtime dan aman.
        </p>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-8 w-full sm:w-auto">
            <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3.5 bg-[#a03e40] hover:bg-[#893537] text-white font-bold rounded-xl shadow-xl shadow-red-900/10 hover:shadow-red-900/20 transition-all text-sm flex items-center justify-center gap-2">
                Mulai Sekarang
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
    
        </div>
    </main>

    <footer class="w-full py-6 text-center text-xs text-slate-400 border-t border-slate-200/50 bg-white/40 backdrop-blur-sm z-10">
        <p>© 2026 Kas Digital Management • SMK Telkom Sidoarjo. Built for transparency.</p>
    </footer>

</body>
</html>