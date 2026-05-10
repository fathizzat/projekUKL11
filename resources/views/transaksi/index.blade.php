<x-app-layout>
    <div class="min-h-screen bg-[#f9f9f9] font-['Plus_Jakarta_Sans'] pb-12">
        <div class="w-full bg-white border-b border-slate-200 px-8 py-4 mb-8">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center gap-2 text-sm">
                    <span class="text-slate-400">Dashboard</span>
                    <span class="text-slate-300">/</span>
                    <span class="font-semibold text-slate-800">Manajemen Kas</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-xs font-medium text-slate-500 bg-slate-100 px-3 py-1 rounded-full">Tahun Ajaran 2025/2026</span>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
                <div>
                    <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Data Kas Kelas</h1>
                    <p class="text-slate-500 mt-2 text-lg">Kelola transparansi keuangan kelas XI SIJA 1 secara digital.</p>
                </div>
                
                <div class="flex gap-3">
                    <button class="flex items-center gap-2 bg-white border border-slate-200 px-5 py-3 rounded-xl text-slate-600 font-bold hover:bg-slate-50 transition-all">
                        <span class="material-symbols-outlined text-xl">file_download</span>
                        Export PDF
                    </button>
                    @if(in_array(Auth::user()->role, ['admin', 'bendahara']))
                    <a href="{{ route('transaksi.create') }}" class="flex items-center gap-2 bg-[#a03e40] hover:bg-[#893537] text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-red-900/10 transition-all">
                        <span class="material-symbols-outlined text-xl">add_circle</span>
                        Tambah Data
                    </a>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Total Saldo Kas</p>
                            <h3 class="text-3xl font-extrabold text-slate-900 mt-2">Rp 1,248,000</h3>
                        </div>
                        <div class="bg-red-50 p-3 rounded-xl">
                            <span class="material-symbols-outlined text-[#a03e40]">account_balance_wallet</span>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-xs">
                        <span class="text-green-600 font-bold flex items-center">+2.4%</span>
                        <span class="text-slate-400">dari bulan lalu</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Total Pemasukan</p>
                            <h3 class="text-3xl font-extrabold text-slate-900 mt-2 text-green-600">Rp 2,000,000</h3>
                        </div>
                        <div class="bg-green-50 p-3 rounded-xl">
                            <span class="material-symbols-outlined text-green-600">trending_up</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Total Pengeluaran</p>
                            <h3 class="text-3xl font-extrabold text-slate-900 mt-2 text-[#a03e40]">Rp 752,000</h3>
                        </div>
                        <div class="bg-red-50 p-3 rounded-xl">
                            <span class="material-symbols-outlined text-[#a03e40]">trending_down</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="relative w-full md:w-96">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400 text-xl">search</span>
                        <input type="text" placeholder="Cari keterangan atau nama pembayar..." class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-200 focus:border-[#a03e40] outline-none transition-all">
                    </div>
                    <div class="flex gap-2 text-sm font-bold text-slate-500">
                        <button class="px-4 py-2 bg-slate-100 rounded-lg text-[#a03e40]">Semua</button>
                        <button class="px-4 py-2 hover:bg-slate-50 rounded-lg transition-colors">Masuk</button>
                        <button class="px-4 py-2 hover:bg-slate-50 rounded-lg transition-colors">Keluar</button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-[11px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                                <th class="px-8 py-4">ID Transaksi</th>
                                <th class="px-8 py-4">Informasi Transaksi</th>
                                <th class="px-8 py-4">Kategori</th>
                                <th class="px-8 py-4 text-right">Nominal</th>
                                <th class="px-8 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-sm">
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-8 py-5 font-mono text-slate-400 text-xs">#TRX-94821</td>
                                <td class="px-8 py-5">
                                    <div class="font-bold text-slate-800">Iuran Mingguan - Mei Pekan 1</div>
                                    <div class="text-xs text-slate-400 mt-0.5 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                                        12 Mei 2026 • Oleh Fathizzat
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[11px] font-bold uppercase bg-green-50 text-green-700 border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                                        Pemasukan
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right font-bold text-slate-900 text-base">Rp 50,000</td>
                                <td class="px-8 py-5">
                                    <div class="flex justify-center gap-2">
                                        <button class="p-2 text-slate-400 hover:text-[#a03e40] hover:bg-red-50 rounded-lg transition-all">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </button>
                                        <button class="p-2 text-slate-400 hover:text-[#a03e40] hover:bg-red-50 rounded-lg transition-all">
                                            <span class="material-symbols-outlined text-xl">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-6 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400 font-medium tracking-wide">
                    <p>Menampilkan 1 - 10 dari 1,248 data</p>
                    <div class="flex gap-2">
                        <button class="p-2 border border-slate-200 rounded-lg hover:bg-slate-50 disabled:opacity-30" disabled>
                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                        </button>
                        <button class="p-2 border border-slate-200 rounded-lg hover:bg-slate-50">
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>