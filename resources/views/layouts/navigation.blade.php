<aside class="fixed left-0 top-0 h-screen w-72 bg-white border-r border-slate-200 z-50 transition-all duration-300 font-['Plus_Jakarta_Sans']">
    <div class="px-8 py-10 flex items-center gap-3">
        <div class="w-10 h-10 bg-[#a03e40] rounded-xl flex items-center justify-center shadow-lg shadow-red-900/20">
            <span class="material-symbols-outlined text-white text-2xl">account_balance</span>
        </div>
        <div>
            <h1 class="text-lg font-black text-slate-800 leading-none uppercase tracking-tighter">Kas Digital</h1>
            <p class="text-[10px] text-slate-400 font-bold tracking-[0.2em] mt-1"></p>
        </div>
    </div>

    <nav class="px-4 space-y-2">

    <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-4">
        Main Menu
    </p>

    <!-- DASHBOARD — Semua role bisa akses -->
    <a href="{{ route('dashboard') }}"
       class="flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all
       {{ request()->routeIs('dashboard') ? 'bg-red-50 text-[#a03e40]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

        <span class="material-symbols-outlined text-2xl">
            dashboard
        </span>

        <span class="font-bold text-sm tracking-tight">
            Dashboard
        </span>

    </a>

    {{-- TRANSAKSI — super_admin, bendahara, anggota --}}
    @if(in_array(Auth::user()->role, ['super_admin', 'bendahara', 'anggota']))

        <button onclick="togglePilihKasGlobalModal(true)"
           class="w-full flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all
           {{ request()->routeIs('transaksi.*') ? 'bg-red-50 text-[#a03e40]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

            <span class="material-symbols-outlined text-2xl">
                receipt_long
            </span>

            <span class="font-bold text-sm tracking-tight">
                Manajemen Kas
            </span>

        </button>

    @endif

    {{-- USER / DAFTAR SISWA — super_admin only --}}
    @if(Auth::user()->role === 'super_admin')

        <a href="{{ route('user.index') }}"
           class="flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all
           {{ request()->routeIs('user.*') ? 'bg-red-50 text-[#a03e40]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

            <span class="material-symbols-outlined text-2xl">
                group
            </span>

            <span class="font-bold text-sm tracking-tight">
                Daftar Siswa
            </span>

        </a>

    @endif

    <div class="pt-8 px-4">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-4">
            Account
        </p>
    </div>

    <a href="{{ route('profile.edit') }}"
        class="flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all
        {{ request()->routeIs('profile.*') ? 'bg-red-50 text-[#a03e40]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

        <span class="material-symbols-outlined text-2xl">
            settings
        </span>

        <span class="font-bold text-sm tracking-tight">
            Pengaturan
        </span>

    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit"
            class="w-full flex items-center gap-4 px-4 py-3.5 rounded-xl text-rose-400 hover:bg-rose-50 hover:text-rose-600 transition-all mt-4">

            <span class="material-symbols-outlined text-2xl">
                logout
            </span>

            <span class="font-bold text-sm tracking-tight">
                Keluar 
            </span>

        </button>

    </form>

</nav>

    <div class="absolute bottom-0 left-0 w-full p-6">
        <div class="bg-slate-50 p-4 rounded-2xl flex items-center gap-3 border border-slate-100">
            <div class="w-10 h-10 rounded-full bg-slate-200 border-2 border-white overflow-hidden shadow-sm">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=a03e40&color=fff" alt="Profile">
            </div>
            <div class="overflow-hidden">
                <p class="text-xs font-black text-slate-800 truncate uppercase">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-400 font-bold uppercase truncate">{{ Auth::user()->role }}</p>
            </div>
        </div>
    </div>
</aside>