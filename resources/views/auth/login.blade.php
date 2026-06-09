<!-- TEST VS CODE -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentikasi - Kas Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <style>
        body { font-family: 'Plus_Jakarta_Sans', sans-serif; }
        .grid-mask {
            mask-image: radial-gradient(circle at center, white 20%, transparent 80%);
            -webkit-mask-image: radial-gradient(circle at center, white 20%, transparent 80%);
        }
        /* Animasi Transisi Slider */
        .auth-container { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .hidden-form { opacity: 0; pointer-events: none; position: absolute; transform: translateY(20px); }
        .active-form { opacity: 1; pointer-events: auto; position: relative; transform: translateY(0); }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <!-- 1. BACKGROUND GRID PATTERN (Statis) -->
    <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden">
        <svg class="absolute inset-0 h-full w-full fill-slate-300/30 stroke-slate-300/50 skew-y-3 grid-mask" aria-hidden="true">
            <defs>
                <pattern id="auth-grid" width="35" height="35" patternUnits="userSpaceOnUse" x="-1" y="-1">
                    <path d="M.5 35V.5H35" fill="none" stroke-dasharray="0" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" stroke-width="0" fill="url(#auth-grid)" />
            <svg x="-1" y="-1" class="overflow-visible fill-slate-200/70">
                <rect stroke-width="0" width="34" height="34" x="141" y="211" />
                <rect stroke-width="0" width="34" height="34" x="701" y="141" />
                <rect stroke-width="0" width="34" height="34" x="841" y="281" />
            </svg>
        </svg>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -z-10 h-96 w-96 rounded-full bg-red-200/20 blur-[120px]"></div>
    </div>

    <!-- 2. CONTAINER FORM DENGAN ANIMASI SLIDER -->
    <div class="w-full max-w-md bg-white rounded-3xl border border-slate-200/80 shadow-2xl shadow-slate-200/60 p-8 z-10 relative auth-container">
        
        <!-- BAGIAN LOGIN -->
        <div id="login-section" class="active-form auth-container">
            <div class="text-center mb-8">
                <div class="inline-flex p-3 bg-red-50 rounded-2xl mb-3 text-[#a03e40]">
                    <span class="material-symbols-outlined text-2xl font-bold">login</span>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Selamat Datang</h2>
                <p class="text-sm text-slate-500 mt-1">Masuk & kelola sistem kas anda.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                </div>
                <button type="submit" class="w-full py-3.5 bg-[#a03e40] hover:bg-[#893537] text-white font-bold rounded-2xl shadow-lg shadow-red-900/10 transition-all text-sm mt-4">
                    Masuk Sekarang
                </button>
            </form>

            <p class="text-center text-xs font-medium text-slate-500 mt-8">
                Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-[#a03e40] hover:underline">Daftar sekarang</a>
            </p>
        </div>

    </div>

    @if ($errors->any())
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                const messages = @json($errors->all());
                if (messages.length) {
                    alert(messages.join('\n'));
                }
            });
        </script>
    @endif

</body>
</html>