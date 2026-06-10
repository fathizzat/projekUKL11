@php
    $kasPilihan = collect();
    if (Auth::check()) {
        $query = \App\Models\KasOrganisasi::query()->with('user')->latest();

        if (Auth::user()->role === 'bendahara' || Auth::user()->role === 'super_admin') {
            $query->where('created_by', Auth::id());
        }

        if (Auth::user()->role === 'anggota') {
            $query->whereHas('anggota', function ($q) {
                $q->where('user_id', Auth::id())
                  ->where('status', 'accepted');
            });
        }

        $kasPilihan = $query->get();
    }
@endphp

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
            { request()->routeIs('transaksi.*') ? 'bg-red-50 text-[#a03e40]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

            <span class="material-symbols-outlined text-2xl">
                receipt_long
            </span>

            <span class="font-bold text-sm tracking-tight">
                Manajemen Kas
            </span>

        </button>

        @if($kasPilihan->isNotEmpty())
            <div class="ml-4 mr-2 space-y-1 pb-1">
                @foreach($kasPilihan as $kas)
                    <a href="{{ route('organisasi.show', $kas) }}" class="flex items-center justify-between gap-3 rounded-2xl border border-slate-100 bg-slate-50/80 px-3 py-2.5 text-xs font-bold text-slate-700 transition hover:border-[#ea6b6b]/30 hover:bg-[#fff4f4] hover:text-[#a03e40]">
                        <span class="truncate">{{ $kas->nama_organisasi }}</span>
                        <span class="material-symbols-outlined text-base text-[#ea6b6b]">arrow_forward</span>
                    </a>
                @endforeach
            </div>
        @endif

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