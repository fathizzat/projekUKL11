<x-app-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-800">Dashboard Kas</h2>
            <p class="text-gray-500 italic">Role: {{ ucfirst(Auth::user()->role) }}</p>
        </div>
        @if(in_array(Auth::user()->role, ['admin', 'bendahara']))
            <button class="bg-rose-500 text-white px-6 py-2 rounded-xl hover:bg-rose-600 transition shadow-lg">
                + Tambah Transaksi
            </button>
        @endif
    </div>

    <!-- Ringkasan Saldo -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <span class="text-gray-400 text-sm">Total Saldo</span>
            <h3 class="text-2xl font-bold text-gray-800">Rp 1.500.000</h3>
        </div>
        <!-- Tambahkan card lain di sini -->
    </div>

    <!-- Tabel CRUD -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Keterangan</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Jumlah</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <tr>
                    <td class="px-6 py-4 text-sm font-medium">Iuran Kas Minggu 1</td>
                    <td class="px-6 py-4 text-sm text-green-600 font-bold">Rp 20.000</td>
                    <td class="px-6 py-4 text-center">
                        @if(in_array(Auth::user()->role, ['admin', 'bendahara']))
                            <button class="text-blue-500 hover:underline mr-2">Edit</button>
                            <button class="text-red-500 hover:underline">Hapus</button>
                        @else
                            <span class="text-gray-300 italic">Read Only</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>