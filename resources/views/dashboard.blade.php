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
                Selamat Datang Kembali, Admin!
            </h1>

            <p class="text-lg text-slate-500 mt-2">
                Berikut adalah ringkasan pengelolaan dana kelas Anda untuk hari ini.
            </p>

        </div>

        <!-- GRID -->
        <div class="grid grid-cols-12 gap-6">

            <!-- LEFT -->
            <div class="col-span-9 space-y-6">

                <!-- MAIN CARD -->
                <div class="bg-[#fffdfd] rounded-[30px] border border-[#f1eaea] p-8 min-h-[360px] flex flex-col justify-between">

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
                        <div class="grid grid-cols-2 mt-16 gap-10">

                            <div>

                                <p class="text-sm uppercase tracking-[0.2em] font-black text-slate-300">
                                    Total Saldo Kas
                                </p>

                                <div class="flex items-end gap-2 mt-4 flex-wrap">

                                    <span class="text-2xl font-black text-slate-400">
                                        Rp
                                    </span>

                                    <h1 class="text-5xl font-black text-slate-900 leading-none">
                                        1.000.000
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
                    <div class="flex items-center gap-4 mt-10">

                        <button class="h-[56px] px-7 bg-[#ea6b6b] rounded-2xl text-white font-bold text-sm hover:bg-[#df5f5f] transition-all flex items-center gap-3">

                            <span class="material-symbols-outlined text-[20px]">
                                person_add
                            </span>

                            Quick Add Member

                        </button>

                        <button class="h-[56px] px-7 border-2 border-[#ea6b6b] text-[#ea6b6b] rounded-2xl font-bold text-sm hover:bg-[#fff4f4] transition-all flex items-center gap-3">

                            <span class="material-symbols-outlined text-[20px]">
                                visibility
                            </span>

                            View Details

                        </button>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="col-span-3">

                <div class="bg-white rounded-[30px] border border-slate-100 p-6">

                    <div class="flex items-center justify-between mb-6">

                        <h2 class="text-2xl font-black text-slate-800">
                            Catatan
                        </h2>

                        <button class="text-[#ea6b6b] text-sm font-bold">
                            See All
                        </button>

                    </div>

                    <!-- NOTE -->
                    <div class="bg-[#fffaf1] border-l-4 border-[#fbbf24] rounded-2xl p-5">

                        <h3 class="text-lg font-black text-slate-700">
                            Tagihan Bulan Oktober
                        </h3>

                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                            Jangan lupa ingatkan siswa untuk melunasi kas sebelum kegiatan study tour minggu depan.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>