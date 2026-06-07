<x-app-layout>
    <div class="font-['Plus_Jakarta_Sans'] text-slate-800">
        <div class="w-full bg-white border-b border-slate-200 px-12 py-5 mb-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2 text-sm">
                    <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-slate-600">Dashboard</a>
                    <span class="text-slate-300">/</span>
                    <a href="{{ route('transaksi.index') }}" class="text-slate-400 hover:text-slate-600">Manajemen Kas</a>
                    <span class="text-slate-300">/</span>
                    <span class="font-semibold text-slate-800">Edit Transaksi</span>
                </div>
            </div>
        </div>

        <div class="px-12 pb-12">

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl text-sm font-bold">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Edit Transaksi</h1>
                <p class="text-slate-500 mt-1 text-sm">Perbarui informasi transaksi kas kelas.</p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 max-w-2xl">
                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Keterangan</label>
                        <input type="text" name="keterangan" value="{{ old('keterangan', $transaksi->keterangan) }}" placeholder="Contoh: Iuran Minggu ke-1" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Jenis Transaksi</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="border border-slate-200 p-3 rounded-xl flex items-center gap-2 cursor-pointer hover:bg-slate-50">
                                <input type="radio" name="jenis_transaksi" value="pemasukan" {{ old('jenis_transaksi', $transaksi->jenis_transaksi) === 'pemasukan' ? 'checked' : '' }} class="text-[#a03e40] focus:ring-[#a03e40]">
                                <span class="text-sm font-bold text-slate-700">Pemasukan</span>
                            </label>
                            <label class="border border-slate-200 p-3 rounded-xl flex items-center gap-2 cursor-pointer hover:bg-slate-50">
                                <input type="radio" name="jenis_transaksi" value="pengeluaran" {{ old('jenis_transaksi', $transaksi->jenis_transaksi) === 'pengeluaran' ? 'checked' : '' }} class="text-[#a03e40] focus:ring-[#a03e40]">
                                <span class="text-sm font-bold text-slate-700">Pengeluaran</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Nominal (Rupiah)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-sm font-bold text-slate-400">Rp</span>
                            <input type="number" name="nominal" required min="1" value="{{ old('nominal', $transaksi->nominal) }}" class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal</label>
                        <input type="date" name="tanggal" required value="{{ old('tanggal', $transaksi->tanggal->format('Y-m-d')) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                    </div>

                    <div class="pt-4 flex gap-3">
                        <a href="{{ route('transaksi.index') }}" class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition-all text-sm text-center">Batal</a>
                        <button type="submit" class="flex-1 py-3 bg-[#a03e40] hover:bg-[#893537] text-white rounded-xl font-bold transition-all text-sm shadow-md">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
