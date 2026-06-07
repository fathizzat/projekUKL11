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

        <!-- STATS CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <!-- Total Saldo Kas -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Saldo Kas</p>
                        <h3 class="text-2xl font-extrabold text-slate-900 mt-2">
                            Rp {{ number_format($totalSaldo, 0, ',', '.') }}
                        </h3>
                    </div>
                    <div class="bg-blue-50 p-2.5 rounded-xl">
                        <span class="material-symbols-outlined text-blue-600 text-xl">account_balance_wallet</span>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2 text-xs">
                    <span class="text-green-600 font-bold">+Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span>
                    <span class="text-slate-300">|</span>
                    <span class="text-red-500 font-bold">-Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Total Anggota -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Anggota</p>
                        <h3 class="text-2xl font-extrabold text-slate-900 mt-2">{{ $totalAnggota }}</h3>
                    </div>
                    <div class="bg-green-50 p-2.5 rounded-xl">
                        <span class="material-symbols-outlined text-green-600 text-xl">groups</span>
                    </div>
                </div>
                <p class="mt-4 text-xs text-slate-400 font-semibold">Anggota terdaftar</p>
            </div>

            <!-- Total Bendahara -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Bendahara</p>
                        <h3 class="text-2xl font-extrabold text-slate-900 mt-2">{{ $totalBendahara }}</h3>
                    </div>
                    <div class="bg-amber-50 p-2.5 rounded-xl">
                        <span class="material-symbols-outlined text-amber-600 text-xl">manage_accounts</span>
                    </div>
                </div>
                <p class="mt-4 text-xs text-slate-400 font-semibold">Bendahara aktif</p>
            </div>

            <!-- Total Transaksi -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Transaksi</p>
                        <h3 class="text-2xl font-extrabold text-slate-900 mt-2">{{ $totalTransaksi }}</h3>
                    </div>
                    <div class="bg-purple-50 p-2.5 rounded-xl">
                        <span class="material-symbols-outlined text-purple-600 text-xl">receipt_long</span>
                    </div>
                </div>
                <p class="mt-4 text-xs text-slate-400 font-semibold">Seluruh transaksi tercatat</p>
            </div>

        </div>

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

                        @if(in_array(Auth::user()->role, ['super_admin', 'bendahara']))
                        <a href="{{ route('transaksi.index') }}" class="h-[56px] px-7 border-2 border-[#ea6b6b] text-[#ea6b6b] rounded-2xl font-bold text-sm hover:bg-[#fff4f4] transition-all flex items-center gap-3">

                            <span class="material-symbols-outlined text-[20px]">
                                visibility
                            </span>

                            Lihat Transaksi

                        </a>
                        @endif

                    </div>

                </div>

            </div>

            <!-- RIGHT: RECENT TRANSACTIONS -->
            <div class="col-span-12 lg:col-span-4">

                <div class="bg-white rounded-[30px] border border-slate-100 p-6">

                    <div class="flex items-center justify-between mb-6">

                        <h2 class="text-xl font-black text-slate-800">
                            Transaksi Terbaru
                        </h2>

                        @if(in_array(Auth::user()->role, ['super_admin', 'bendahara']))
                        <a href="{{ route('transaksi.index') }}" class="text-[#ea6b6b] text-sm font-bold hover:underline">
                            See All
                        </a>
                        @endif

                    </div>

                    @forelse($transaksiTerbaru as $trx)
                    <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0
                                {{ $trx->jenis_transaksi === 'pemasukan' ? 'bg-green-50' : 'bg-red-50' }}">
                                <span class="material-symbols-outlined text-lg
                                    {{ $trx->jenis_transaksi === 'pemasukan' ? 'text-green-600' : 'text-red-500' }}">
                                    {{ $trx->jenis_transaksi === 'pemasukan' ? 'trending_up' : 'trending_down' }}
                                </span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-800 truncate">{{ $trx->keterangan ?? 'Transaksi' }}</p>
                                <p class="text-[11px] text-slate-400">{{ $trx->tanggal->format('d M Y') }}</p>
                            </div>
                        </div>
                        <p class="text-sm font-extrabold flex-shrink-0 ml-3
                            {{ $trx->jenis_transaksi === 'pemasukan' ? 'text-green-600' : 'text-red-500' }}">
                            {{ $trx->jenis_transaksi === 'pemasukan' ? '+' : '-' }}Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                        </p>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <span class="material-symbols-outlined text-4xl text-slate-300">receipt_long</span>
                        <p class="text-sm text-slate-400 mt-2">Belum ada transaksi</p>
                    </div>
                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>