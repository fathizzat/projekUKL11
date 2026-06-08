<x-app-layout>
    <div class="font-['Plus_Jakarta_Sans'] text-slate-800">
        <!-- HEADER -->
        <div class="w-full bg-white border-b border-slate-200 px-12 py-5 mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-slate-500 hover:text-slate-800 font-bold transition-colors">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    Kembali
                </a>
                <span class="text-slate-300">|</span>
                <h1 class="text-xl font-black text-slate-800">XI SIJA 1</h1>
            </div>
        </div>

        <div class="px-12 pb-12">
            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3">
                    <span class="material-symbols-outlined text-green-500">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl text-sm font-bold">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- TOP CARDS -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                <!-- RED CARD -->
                <div class="lg:col-span-2 bg-[#a03e40] rounded-[30px] p-10 text-white relative overflow-hidden shadow-xl shadow-red-900/10">
                    <p class="text-sm font-bold uppercase tracking-widest text-red-200 mb-2">Total Saldo Kas</p>
                    <h2 class="text-5xl font-black mb-4">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h2>
                    <div class="flex items-center gap-4 mb-10">
                        <span class="inline-flex items-center gap-1 bg-white/20 px-3 py-1 rounded-full text-xs font-bold">
                            <span class="material-symbols-outlined text-[16px]">trending_up</span>
                            +12.5% bulan ini
                        </span>
                        <span class="text-xs font-medium text-red-200">Terakhir diperbarui: Hari ini</span>
                    </div>

                    <div class="flex items-center gap-4">
                        @if(in_array(Auth::user()->role, ['bendahara', 'super_admin']))
                        <button class="bg-white text-[#a03e40] px-8 py-3 rounded-xl font-bold hover:bg-slate-50 transition-colors shadow-sm">
                            Tarik Dana
                        </button>
                        <button onclick="toggleKasModal(true)" class="bg-white/20 text-white border border-white/30 px-8 py-3 rounded-xl font-bold hover:bg-white/30 transition-colors">
                            Input Manual
                        </button>
                        @endif

                        @if(Auth::user()->role === 'anggota')
                        <button onclick="toggleKasModal(true)" class="bg-white text-[#a03e40] px-8 py-3 rounded-xl font-bold hover:bg-slate-50 transition-colors shadow-sm flex items-center gap-2">
                            <span class="material-symbols-outlined">add_circle</span>
                            Ajukan Kas
                        </button>
                        @endif
                    </div>
                </div>

                <!-- BENDAHARA CARD -->
                <div class="bg-white rounded-[30px] border border-slate-100 p-8 flex flex-col items-center justify-center text-center shadow-sm">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-6">Bendahara</p>
                    
                    <div class="w-20 h-20 rounded-full bg-slate-200 mb-4 overflow-hidden border-4 border-white shadow-md">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($bendahara->name ?? 'Bendahara') }}&background=random" alt="Bendahara" class="w-full h-full object-cover">
                    </div>
                    
                    <h3 class="text-lg font-bold text-slate-800">{{ $bendahara->name ?? 'Belum Ditentukan' }}</h3>
                    <p class="text-xs text-slate-500 mb-4">NIP: {{ $bendahara->id ?? '-' }}</p>
                    
                    <div class="flex items-center gap-2 mb-6">
                        <span class="bg-slate-100 text-slate-500 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Verified</span>
                        <span class="bg-red-50 text-[#a03e40] text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Main Admin</span>
                    </div>
                </div>
            </div>

            <!-- ANGGOTA TABLE -->
            <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-8">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h2 class="text-xl font-black text-slate-800">Daftar Anggota</h2>
                        <p class="text-sm text-slate-500 mt-1">Total {{ $anggotas->count() }} Anggota terdaftar di XI SIJA 1</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="bg-[#a03e40] hover:bg-[#893537] text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">download</span>
                            Export
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">
                                <th class="pb-4 pr-6 w-16">No</th>
                                <th class="pb-4 px-6">Nama Anggota</th>
                                <th class="pb-4 px-6">Total Bayar</th>
                                <th class="pb-4 px-6">Status</th>
                                <th class="pb-4 pl-6 text-right w-20">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($anggotas as $index => $anggota)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="py-5 pr-6 text-slate-500 font-mono text-xs">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-[#a03e40] font-bold text-sm">
                                            {{ substr($anggota->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">{{ $anggota->name }}</p>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Anggota</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5 px-6 font-extrabold text-slate-900">
                                    Rp {{ number_format($anggota->total_bayar, 0, ',', '.') }}
                                </td>
                                <td class="py-5 px-6">
                                    @if($anggota->status_kas === 'lunas')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-widest bg-green-50 text-green-600">
                                        Lunas
                                    </span>
                                    @elseif($anggota->status_kas === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-widest bg-amber-50 text-amber-600">
                                        Pending
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-widest bg-red-50 text-red-500">
                                        Tunggakan
                                    </span>
                                    @endif
                                </td>
                                <td class="py-5 pl-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($anggota->status_kas === 'pending' && in_array(Auth::user()->role, ['bendahara', 'super_admin']) && $anggota->kas_id)
                                        <form action="{{ route('transaksi.konfirmasi', $anggota->kas_id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-100 hover:bg-green-200 text-green-700 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors">
                                                Konfirmasi
                                            </button>
                                        </form>
                                        @endif
                                        <button class="text-slate-400 hover:text-slate-600 p-2">
                                            <span class="material-symbols-outlined text-xl">more_vert</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-slate-400">Belum ada anggota yang terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-6">
                    <p class="text-xs font-bold text-slate-500">Menampilkan 1-{{ min($anggotas->count(), 10) }} dari {{ $anggotas->count() }} Anggota</p>
                    <div class="flex items-center gap-2">
                        <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-slate-50"><span class="material-symbols-outlined text-sm">chevron_left</span></button>
                        <button class="w-8 h-8 rounded-lg bg-[#a03e40] text-white font-bold text-xs">1</button>
                        <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50">2</button>
                        <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-slate-50"><span class="material-symbols-outlined text-sm">chevron_right</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PENGAJUAN / INPUT KAS -->
    <div id="kasModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-[30px] w-[28rem] shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-extrabold text-slate-800 text-lg">{{ in_array(Auth::user()->role, ['bendahara', 'super_admin']) ? 'Input Kas Manual' : 'Pengajuan Kas' }}</h3>
                <button onclick="toggleKasModal(false)" class="text-slate-400 hover:text-slate-600 flex">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form action="{{ route('transaksi.store') }}" method="POST" class="p-8 space-y-5">
                @csrf
                <input type="hidden" name="jenis_transaksi" value="pemasukan">
                
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Keterangan / Catatan</label>
                    <input type="text" name="keterangan" placeholder="Contoh: Iuran Minggu ke-1" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Nominal (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute left-5 top-[14px] text-sm font-bold text-slate-400">Rp</span>
                        <input type="number" name="nominal" required min="1" class="w-full pl-12 pr-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                    </div>
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal</label>
                    <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                </div>
                
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="toggleKasModal(false)" class="flex-1 py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition-all text-sm">Batal</button>
                    <button type="submit" class="flex-1 py-3.5 bg-[#a03e40] hover:bg-[#893537] text-white rounded-xl font-bold transition-all text-sm shadow-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleKasModal(show) {
            const modal = document.getElementById('kasModal');
            const content = modal.querySelector('div');
            if(show) {
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
</x-app-layout>