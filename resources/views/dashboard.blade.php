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

            <button type="button" class="relative text-slate-400 hover:text-slate-600" aria-label="Notifikasi join">
                <span class="material-symbols-outlined">notifications</span>
                @if(!empty($pendingJoinCount))
                    <span class="absolute -top-1 -right-1 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-[#ea6b6b] px-1 text-[10px] font-black text-white">{{ $pendingJoinCount }}</span>
                @endif
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
                Berikut adalah ringkasan pengelolaan Kas Anda untuk hari ini.
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

            <div class="col-span-12">
                <div class="rounded-[30px] bg-white border border-slate-100 p-8 shadow-sm">
                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4 mb-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-[#ea6b6b] font-black">Dashboard Kas</p>
                            <h2 class="text-2xl font-black text-slate-800 mt-2">Preview Kas / Organisasi</h2>
                            
                        </div>
                        @if(in_array(Auth::user()->role, ['super_admin', 'bendahara']))
                            <button type="button" onclick="toggleKasOrganisasiModal(true)" class="h-[52px] px-6 rounded-2xl bg-[#ea6b6b] text-white font-bold text-sm hover:bg-[#df5f5f] transition-all flex items-center gap-2 self-start"> <span class="material-symbols-outlined text-[18px]">add_business</span> Buat Kas</button>
                        @elseif(Auth::user()->role === 'anggota')
                            <button type="button" onclick="toggleJoinModal(true)" class="h-[52px] px-6 rounded-2xl bg-[#ea6b6b] text-white font-bold text-sm hover:bg-[#df5f5f] transition-all flex items-center gap-2 self-start"> <span class="material-symbols-outlined text-[18px]">group_add</span> Gabung Kas</button>
                        @endif
                    </div>

                    @if($kasOrganisasis->isEmpty())
                        @if(Auth::user()->role === 'anggota' && $kasOrganisasis->isEmpty())
                            <div class="rounded-[28px] border border-dashed border-slate-200 bg-slate-50 p-10 text-center text-slate-500 space-y-4">
                                <p class="text-lg font-black text-slate-700">Belum bergabung ke kas manapun</p>
                                <button type="button" onclick="toggleJoinModal(true)" class="h-[44px] px-5 rounded-2xl bg-[#ea6b6b] text-white text-sm font-bold hover:bg-[#df5f5f] transition-all">Gabung Kas</button>
                            </div>
                        @else
                            <div class="rounded-[28px] border border-dashed border-slate-200 bg-slate-50 p-10 text-center text-slate-500">Belum ada kas yang dibuat. Silakan buat kas pertama.</div>
                        @endif
                    @else
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                            @foreach($kasOrganisasis as $organisasi)
                                <article class="rounded-[30px] border border-slate-100 bg-[#fffdfd] p-8 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <p class="text-[11px] uppercase tracking-[0.25em] text-slate-400 font-black">Periode Pembayaran</p>
                                            <h3 class="text-2xl font-black text-slate-800 mt-2">{{ $organisasi->nama_organisasi }}</h3>
                                            <p class="text-sm text-slate-500 mt-1">Kode: {{ $organisasi->kode_kelas }}</p>
                                        </div>
                                        <span class="rounded-full bg-red-50 text-[#ea6b6b] text-[11px] font-black px-3 py-1">{{ ucfirst($organisasi->periode_iuran) }}</span>
                                    </div>
                                    <div class="mt-6 space-y-3 text-sm text-slate-700">
                                        <div class="flex justify-between"><span class="text-slate-400">Total Saldo</span><strong class="text-slate-900">Rp {{ number_format($organisasi->saldo, 0, ',', '.') }}</strong></div>
                                        <div class="flex justify-between"><span class="text-slate-400">Periode</span><strong class="text-slate-900">{{ ucfirst($organisasi->periode_iuran) }}</strong></div>
                                        <div class="flex justify-between"><span class="text-slate-400">Iuran</span><strong class="text-slate-900">Rp {{ number_format($organisasi->nominal_iuran, 0, ',', '.') }} / {{ $organisasi->periode_iuran }}</strong></div>
                                    </div>
                                    <div class="mt-6 flex items-center justify-between gap-3">
                                        <a href="{{ route('organisasi.show', $organisasi) }}" class="h-[44px] px-4 rounded-2xl border border-[#ea6b6b] text-[#ea6b6b] text-sm font-bold hover:bg-[#fff4f4] transition-all flex items-center gap-2">Detail Kas</a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    <div id="joinKasModal" class="fixed inset-0 bg-black/50 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-[30px] w-[28rem] shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-[#fffdfd]">
                <div>
                    <h3 class="font-extrabold text-slate-800 text-lg">Gabung Kas</h3>
                    <p class="text-xs text-slate-400 mt-1">Masukkan kode kas untuk mengajukan join.</p>
                </div>
                <button type="button" onclick="toggleJoinModal(false)" class="text-slate-400 hover:text-[#ea6b6b] transition-colors flex">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form action="{{ route('organisasi.join.code') }}" method="POST" class="p-8 space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Kode Kas</label>
                    <input type="text" name="kode_kelas" required placeholder="Contoh: KAS-SIJA2-2026-735" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#ea6b6b] outline-none transition-all">
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="toggleJoinModal(false)" class="flex-1 py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition-all text-sm">Batal</button>
                    <button type="submit" class="flex-1 py-3.5 bg-[#ea6b6b] hover:bg-[#df5f5f] text-white rounded-xl font-bold transition-all text-sm shadow-md">Kirim Pengajuan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleJoinModal(show) {
            const modal = document.getElementById('joinKasModal');
            const content = modal.querySelector('div');
            if (show) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    content.classList.remove('scale-95');
                }, 10);
            } else {
                modal.classList.add('opacity-0');
                content.classList.add('scale-95');
                setTimeout(() => modal.classList.add('hidden'), 300);
            }
        }
    </script>

    <!-- MODAL BUAT KAS / ORGANISASI -->
    @if(in_array(Auth::user()->role, ['super_admin', 'bendahara']))
    <div id="kasOrganisasiModal" class="fixed inset-0 bg-black/50 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-[30px] w-[28rem] shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-[#fffdfd]">
                <div>
                    <h3 class="font-extrabold text-slate-800 text-lg">Buat Kas / Organisasi</h3>
                    <p class="text-xs text-slate-400 mt-1">Saldo otomatis 0, kode kelas akan dibuat otomatis.</p>
                </div>
                <button type="button" onclick="toggleKasOrganisasiModal(false)" class="text-slate-400 hover:text-[#ea6b6b] transition-colors flex">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form action="{{ route('organisasi.store') }}" method="POST" class="p-8 space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Nama Organisasi</label>
                    <input type="text" name="nama_organisasi" required placeholder="Contoh: XI SIJA 1" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#ea6b6b] outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Nominal Iuran</label>
                    <div class="relative">
                        <span class="absolute left-5 top-[14px] text-sm font-bold text-slate-400">Rp</span>
                        <input type="number" name="nominal_iuran" required min="0" step="100" class="w-full pl-12 pr-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#ea6b6b] outline-none transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Periode Iuran</label>
                    <select name="periode_iuran" required class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#ea6b6b] outline-none transition-all">
                        <option value="mingguan">Mingguan</option>
                        <option value="bulanan">Bulanan</option>
                        <option value="tahunan">Tahunan</option>
                    </select>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="toggleKasOrganisasiModal(false)" class="flex-1 py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition-all text-sm">Batal</button>
                    <button type="submit" class="flex-1 py-3.5 bg-[#ea6b6b] hover:bg-[#df5f5f] text-white rounded-xl font-bold transition-all text-sm shadow-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleKasOrganisasiModal(show) {
            const modal = document.getElementById('kasOrganisasiModal');
            const content = modal.querySelector('div');
            if (show) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    content.classList.remove('scale-95');
                }, 10);
            } else {
                modal.classList.add('opacity-0');
                content.classList.add('scale-95');
                setTimeout(() => modal.classList.add('hidden'), 300);
            }
        }
    </script>
    @endif

</x-app-layout>