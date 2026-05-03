<x-app-layout>
    <div class="auth-google-layout min-h-screen bg-gray-50 font-jakarta p-4 md:p-8">
        
        <!-- Header Section -->
        <div class="max-w-7xl mx-auto mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Catatan Kas</h1>
                <p class="text-gray-500 mt-1">Pantau arus masuk dan keluar uang kas XI SIJA 1.</p>
            </div>
            
            @if(in_array(Auth::user()->role, ['admin', 'bendahara']))
            <button class="bg-rose-500 hover:bg-rose-600 text-white px-6 py-3 rounded-2xl shadow-lg shadow-rose-200 transition-all transform hover:scale-105 flex items-center gap-2 font-bold">
                <i class="fa-solid fa-plus-circle text-lg"></i>
                Tambah Transaksi
            </button>
            @endif
        </div>

        <!-- Dashboard Stats -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10 text-rose-500 text-5xl">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Total Saldo</p>
                <h3 class="text-3xl font-black text-gray-800 mt-2">Rp 2.500.000</h3>
            </div>
            
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 border-l-8 border-l-green-500">
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Total Masuk</p>
                <h3 class="text-3xl font-black text-green-600 mt-2">+ Rp 3.200.000</h3>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 border-l-8 border-l-rose-500">
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Total Keluar</p>
                <h3 class="text-3xl font-black text-rose-600 mt-2">- Rp 700.000</h3>
            </div>
        </div>

        <!-- Table Card -->
        <div class="max-w-7xl mx-auto bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-white">
                <h3 class="font-black text-gray-800 text-lg uppercase tracking-tight">Riwayat Transaksi Terkini</h3>
                <div class="flex gap-2">
                    <input type="text" placeholder="Cari transaksi..." class="text-sm bg-gray-50 border-none rounded-xl px-4 py-2 focus:ring-2 focus:ring-rose-500 w-48 md:w-64 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto text-jakarta">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 text-gray-400 text-[10px] uppercase tracking-[0.2em] font-black">
                            <th class="px-8 py-5">Tanggal</th>
                            <th class="px-8 py-5">Deskripsi</th>
                            <th class="px-8 py-5">Kategori</th>
                            <th class="px-8 py-5 text-right">Jumlah</th>
                            <th class="px-8 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <!-- Row Contoh -->
                        <tr class="group hover:bg-rose-50/30 transition-all duration-300">
                            <td class="px-8 py-6 text-sm text-gray-500 font-medium tracking-tight">03 Mei 2026</td>
                            <td class="px-8 py-6">
                                <div class="font-bold text-gray-800 tracking-tight">Iuran Kas Mingguan</div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase mt-1">PIC: Fathizzat</div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase bg-green-100 text-green-600 ring-4 ring-green-50">Pemasukan</span>
                            </td>
                            <td class="px-8 py-6 text-right font-black text-green-600">Rp 50.000</td>
                            <td class="px-8 py-6">
                                <div class="flex justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all">
                                    @if(in_array(Auth::user()->role, ['admin', 'bendahara']))
                                    <button class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition-all flex items-center justify-center">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    @else
                                    <span class="text-gray-300 italic text-xs">Read Only</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>