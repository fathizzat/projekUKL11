<x-app-layout>
    <div class="font-['Plus_Jakarta_Sans'] text-slate-800">
        <div class="w-full bg-white border-b border-slate-200 px-12 py-5 mb-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2 text-sm">
                    <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-slate-600">Dashboard</a>
                    <span class="text-slate-300">/</span>
                    <span class="font-semibold text-slate-800">Manajemen Kas</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-full">Kelas XI SIJA 1</span>
                </div>
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

            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-8 gap-4">
                <div class="block">
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Data Kas Kelas</h1>
                    <p class="text-slate-500 mt-1 text-sm">Kelola transparansi keuangan kelas secara digital.</p>
                </div>

                <div class="flex items-center gap-3 self-start lg:self-auto flex-shrink-0">
                    <button onclick="toggleKasModal(true)" class="flex items-center gap-2 bg-[#a03e40] hover:bg-[#893537] text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-red-900/10 transition-all text-sm h-fit">
                        <span class="material-symbols-outlined text-lg">add_circle</span>
                        Tambah Kas
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden flex flex-col justify-between">
                    <div class="flex justify-between items-start w-full">
                        <div class="overflow-hidden">
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wider truncate">Total Saldo Kas</p>
                            <h3 class="text-2xl font-extrabold text-slate-900 mt-2 truncate">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h3>
                        </div>
                        <div class="bg-red-50 p-2.5 rounded-xl flex-shrink-0 ml-2">
                            <span class="material-symbols-outlined text-[#a03e40] text-xl block">account_balance_wallet</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden flex flex-col justify-between">
                    <div class="flex justify-between items-start w-full">
                        <div class="overflow-hidden">
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wider truncate">Total Pemasukan</p>
                            <h3 class="text-2xl font-extrabold text-green-600 mt-2 truncate">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
                        </div>
                        <div class="bg-green-50 p-2.5 rounded-xl flex-shrink-0 ml-2">
                            <span class="material-symbols-outlined text-green-600 text-xl block">trending_up</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden flex flex-col justify-between">
                    <div class="flex justify-between items-start w-full">
                        <div class="overflow-hidden">
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wider truncate">Total Pengeluaran</p>
                            <h3 class="text-2xl font-extrabold text-[#a03e40] mt-2 truncate">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                        </div>
                        <div class="bg-red-50 p-2.5 rounded-xl flex-shrink-0 ml-2">
                            <span class="material-symbols-outlined text-[#a03e40] text-xl block">trending_down</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="relative w-full md:w-96">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400 text-xl">search</span>
                        <input type="text" id="searchTransaksi" onkeyup="filterTable()" placeholder="Cari transaksi..." class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-200 focus:border-[#a03e40] outline-none transition-all">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left" id="transaksiTable">
                        <thead>
                            <tr class="bg-slate-50/50 text-[11px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                                <th class="px-8 py-4">No</th>
                                <th class="px-8 py-4">Informasi Transaksi</th>
                                <th class="px-8 py-4">Kategori</th>
                                <th class="px-8 py-4 text-right">Nominal</th>
                                <th class="px-8 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($transaksis as $index => $trx)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-5 font-mono text-slate-400 text-xs">{{ $index + 1 }}</td>
                                <td class="px-8 py-5">
                                    <div class="font-bold text-slate-800">{{ $trx->keterangan ?? '-' }}</div>
                                    <div class="text-xs text-slate-400 mt-1 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                                        {{ $trx->tanggal->format('d M Y') }} • Oleh {{ $trx->user->name ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    @if($trx->jenis_transaksi === 'pemasukan')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[11px] font-bold uppercase bg-green-50 text-green-700 border border-green-100">
                                        Pemasukan
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[11px] font-bold uppercase bg-red-50 text-[#a03e40] border border-red-100">
                                        Pengeluaran
                                    </span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 text-right font-bold text-slate-900 text-base">Rp {{ number_format($trx->nominal, 0, ',', '.') }}</td>
                                <td class="px-8 py-5">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('transaksi.edit', $trx->id) }}" class="p-2 text-slate-400 hover:text-[#a03e40] hover:bg-red-50 rounded-lg transition-all">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </a>
                                        <form action="{{ route('transaksi.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-[#a03e40] hover:bg-red-50 rounded-lg transition-all">
                                                <span class="material-symbols-outlined text-xl">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-12 text-center">
                                    <span class="material-symbols-outlined text-4xl text-slate-300">receipt_long</span>
                                    <p class="text-sm text-slate-400 mt-2">Belum ada data transaksi</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH KAS -->
    <div id="kasModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-2xl w-[28rem] shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="px-6 py-5 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-extrabold text-slate-800">Catat Kas Baru</h3>
                <button onclick="toggleKasModal(false)" class="text-slate-400 hover:text-slate-600 flex">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form action="{{ route('transaksi.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Keterangan</label>
                    <input type="text" name="keterangan" placeholder="Contoh: Iuran Minggu ke-1" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Jenis Transaksi</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="border border-slate-200 p-3 rounded-xl flex items-center gap-2 cursor-pointer hover:bg-slate-50">
                            <input type="radio" name="jenis_transaksi" value="pemasukan" checked class="text-[#a03e40] focus:ring-[#a03e40]">
                            <span class="text-sm font-bold text-slate-700">Pemasukan</span>
                        </label>
                        <label class="border border-slate-200 p-3 rounded-xl flex items-center gap-2 cursor-pointer hover:bg-slate-50">
                            <input type="radio" name="jenis_transaksi" value="pengeluaran" class="text-[#a03e40] focus:ring-[#a03e40]">
                            <span class="text-sm font-bold text-slate-700">Pengeluaran</span>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Nominal (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-sm font-bold text-slate-400">Rp</span>
                        <input type="number" name="nominal" required min="1" class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal</label>
                    <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="toggleKasModal(false)" class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition-all text-sm">Batal</button>
                    <button type="submit" class="flex-1 py-3 bg-[#a03e40] hover:bg-[#893537] text-white rounded-xl font-bold transition-all text-sm shadow-md">Tambah Kas</button>
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

        function filterTable() {
            const input = document.getElementById('searchTransaksi').value.toLowerCase();
            const rows = document.querySelectorAll('#transaksiTable tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? '' : 'none';
            });
        }
    </script>
</x-app-layout>