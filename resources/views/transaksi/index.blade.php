<x-app-layout>
    <div class="font-['Plus_Jakarta_Sans'] text-slate-800">
        <div class="w-full bg-white border-b border-slate-200 px-12 py-5 mb-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2 text-sm">
                    <span class="text-slate-400">Dashboard</span>
                    <span class="text-slate-300">/</span>
                    <span class="font-semibold text-slate-800">Manajemen Kas</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-full">Kelas XI SIJA 1</span>
                </div>
            </div>
        </div>

        <div class="px-12 pb-12">
            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-8 gap-4">
                <div class="block">
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Data Kas Kelas</h1>
                    <p class="text-slate-500 mt-1 text-sm">Kelola transparansi keuangan kelas secara digital.</p>
                </div>
                
                <div class="flex items-center gap-3 self-start lg:self-auto flex-shrink-0">
                    <button class="flex items-center gap-2 bg-white border border-slate-200 px-4 py-2.5 rounded-xl text-slate-600 font-bold hover:bg-slate-50 transition-all text-sm h-fit">
                        <span class="material-symbols-outlined text-lg">file_download</span>
                        Export PDF
                    </button>
                    
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
                            <h3 class="text-2xl font-extrabold text-slate-900 mt-2 truncate">Rp 1,248,000</h3>
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
                            <h3 class="text-2xl font-extrabold text-green-600 mt-2 truncate">Rp 2,000,000</h3>
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
                            <h3 class="text-2xl font-extrabold text-[#a03e40] mt-2 truncate">Rp 752,000</h3>
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
                        <input type="text" placeholder="Cari transaksi..." class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-200 focus:border-[#a03e40] outline-none transition-all">
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
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-5 font-mono text-slate-400 text-xs">#TRX-94821</td>
                                <td class="px-8 py-5">
                                    <div class="font-bold text-slate-800">Iuran Mingguan - Mei Pekan 1</div>
                                    <div class="text-xs text-slate-400 mt-1 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                                        12 Mei 2026 • Oleh Fathizzat
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[11px] font-bold uppercase bg-green-50 text-green-700 border border-green-100">
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
            </div>
        </div>
    </div>

    <div id="kasModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-2xl w-[28rem] shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="px-6 py-5 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-extrabold text-slate-800">Catat Kas Baru</h3>
                <button onclick="toggleKasModal(false)" class="text-slate-400 hover:text-slate-600 flex">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form action="#" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tambah Kas Baru</label>
                    <input type="text" name="keterangan" placeholder="Contoh: Iuran Minggu ke-1" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Jenis Kas</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="border border-slate-200 p-3 rounded-xl flex items-center gap-2 cursor-pointer hover:bg-slate-50">
                            <input type="radio" name="tipe" value="masuk" checked class="text-[#a03e40] focus:ring-[#a03e40]">
                            <span class="text-sm font-bold text-slate-700">Organisasi</span>
                        </label>
                        <label class="border border-slate-200 p-3 rounded-xl flex items-center gap-2 cursor-pointer hover:bg-slate-50">
                            <input type="radio" name="tipe" value="keluar" class="text-[#a03e40] focus:ring-[#a03e40]">
                            <span class="text-sm font-bold text-slate-700">Kelas</span>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Nominal (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-sm font-bold text-slate-400">Rp</span>
                        <input type="number" name="nominal" required class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                    </div>
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
    </script>
</x-app-layout>