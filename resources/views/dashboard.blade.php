<x-app-layout>

<div class="min-h-screen bg-[#f6f7fb] font-['Plus_Jakarta_Sans']">

    <!-- TOPBAR -->
    <div class="h-[88px] bg-white border-b border-slate-200 flex items-center justify-between px-10">

        <div class="flex items-center gap-8">

            <h1 class="text-[28px] font-black text-slate-800">
                Kas Digital
            </h1>

            <div class="relative">

                <input
                    type="text"
                    placeholder="Search data..."
                    class="w-[280px] h-[46px] bg-[#f3f5f9] rounded-full pl-12 pr-4 text-sm outline-none focus:ring-2 focus:ring-[#ea6b6b]/20"
                >

                <span class="material-symbols-outlined absolute left-4 top-[11px] text-slate-400 text-[20px]">
                    search
                </span>

            </div>

        </div>

        <div class="flex items-center gap-6">

            <button class="text-slate-400 hover:text-slate-600">
                <span class="material-symbols-outlined">notifications</span>
            </button>

            <button class="text-slate-400 hover:text-slate-600">
                <span class="material-symbols-outlined">help</span>
            </button>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="p-8">

        <!-- TITLE -->
        <div class="mb-8">

            <h1 class="text-4xl font-black text-slate-900">
                Selamat Datang, {{ Auth::user()->name }}!
            </h1>

            <p class="text-lg text-slate-500 mt-2">
                Berikut adalah ringkasan pengelolaan dana kelas Anda untuk hari ini.
            </p>

        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3">
                <span class="material-symbols-outlined text-green-500">check_circle</span>
                {{ session('success') }}
            </div>
        @endif


        <!-- GRID -->
        <div class="grid grid-cols-12 gap-6">

            <!-- LEFT: MAIN CARD -->
            <div class="col-span-12 lg:col-span-8 space-y-6">

                <!-- MAIN CARD -->
                <div class="bg-[#fffdfd] rounded-[30px] border border-[#f1eaea] p-8 min-h-[280px] flex flex-col justify-between">

                    <div>

                        <div class="flex justify-between items-start">

                            <div>

                                <div class="inline-flex px-4 py-2 rounded-full bg-[#fff1f1] text-[#ea6b6b] text-xs font-black uppercase">
                                    Primary Organization
                                </div>

                                <h2 class="text-4xl font-black text-slate-800 mt-5">
                                    XI SIJA 1
                                </h2>

                            </div>

                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center">

                                <span class="material-symbols-outlined text-slate-300">
                                    groups
                                </span>

                            </div>

                        </div>

                        <!-- INFO -->
                        <div class="grid grid-cols-2 mt-10 gap-10">

                            <div>

                                <p class="text-sm uppercase tracking-[0.2em] font-black text-slate-300">
                                    Total Saldo Kas
                                </p>

                                <div class="flex items-end gap-2 mt-4 flex-wrap">

                                    <span class="text-2xl font-black text-slate-400">
                                        Rp
                                    </span>

                                    <h1 class="text-4xl font-black text-slate-900 leading-none">
                                        {{ number_format($totalSaldo, 0, ',', '.') }}
                                    </h1>

                                </div>

                            </div>

                            <div>

                                <p class="text-sm uppercase tracking-[0.2em] font-black text-slate-300">
                                    Waktu Bayar
                                </p>

                                <h2 class="text-2xl font-black text-slate-800 mt-4">
                                    Setiap Senin
                                </h2>

                            </div>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex items-center gap-4 mt-8">

                        @if(in_array(Auth::user()->role, ['super_admin']))
                        <a href="{{ route('user.index') }}" class="h-[56px] px-7 bg-[#ea6b6b] rounded-2xl text-white font-bold text-sm hover:bg-[#df5f5f] transition-all flex items-center gap-3">

                            <span class="material-symbols-outlined text-[20px]">
                                person_add
                            </span>

                            Manajemen User

                        </a>
                        @endif

                        @if(in_array(Auth::user()->role, ['super_admin', 'bendahara', 'anggota']))
                        <a href="{{ route('transaksi.index') }}" class="h-[56px] px-7 border-2 border-[#ea6b6b] text-[#ea6b6b] rounded-2xl font-bold text-sm hover:bg-[#fff4f4] transition-all flex items-center gap-3 relative z-10">

                            <span class="material-symbols-outlined text-[20px]">
                                visibility
                            </span>

                            Detail Kas

                        </a>
                        @endif

                    </div>

                </div>

            </div>

            <!-- RIGHT: NOTES -->
            <div class="col-span-12 lg:col-span-4">

                <div class="bg-white rounded-[30px] border border-slate-100 p-6">

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-500 text-[24px]">
                                sticky_note_2
                            </span>
                            <h2 class="text-xl font-black text-slate-800">
                                Catatan
                            </h2>
                        </div>

                        <a href="#" class="text-[#ea6b6b] text-sm font-bold hover:underline">
                            See All
                        </a>
                    </div>

                    <div class="space-y-4">
                        <!-- Note Item 1 -->
                        <div class="relative bg-[#fffdf9] rounded-2xl p-5 border border-amber-100 overflow-hidden">
                            <!-- Left Accent -->
                            <div class="absolute left-0 top-4 bottom-4 w-1.5 bg-amber-400 rounded-r-md"></div>
                            
                            <h3 class="text-[15px] font-bold text-slate-700 mb-2">Tagihan Bulan Oktober</h3>
                            <p class="text-[13px] text-slate-500 leading-relaxed mb-3">
                                Jangan lupa ingatkan siswa untuk melunasi kas sebelum kegiatan study tour minggu depan.
                            </p>
                            <p class="text-[11px] text-slate-400 font-medium">
                                Today, 09:45 AM
                            </p>
                        </div>

                        <!-- Note Item 2 -->
                        <div class="relative bg-[#f8f9fc] rounded-2xl p-5 border border-slate-100 overflow-hidden">
                            <!-- Left Accent -->
                            <div class="absolute left-0 top-4 bottom-4 w-1.5 bg-slate-300 rounded-r-md"></div>
                            
                            <h3 class="text-[15px] font-bold text-slate-700 mb-2">Perbaikan LCD Proyektor</h3>
                            <p class="text-[13px] text-slate-500 leading-relaxed mb-3">
                                Estimasi biaya perbaikan Rp 250.000 menggunakan saldo dana darurat.
                            </p>
                            <p class="text-[11px] text-slate-400 font-medium">
                                Yesterday, 02:15 PM
                            </p>
                        </div>

                        <!-- Add Note Button (Bendahara Only) -->
                        @if(Auth::user()->role === 'bendahara' || Auth::user()->role === 'super_admin')
                        <button class="w-full mt-2 py-6 rounded-2xl border-2 border-dashed border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-colors flex flex-col items-center justify-center gap-2 group">
                            <span class="material-symbols-outlined text-slate-400 group-hover:text-slate-500 text-[28px]">
                                post_add
                            </span>
                            <span class="text-xs font-bold text-slate-400 group-hover:text-slate-500 tracking-wider uppercase">
                                ADD NEW NOTE
                            </span>
                        </button>
                        @endif
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>