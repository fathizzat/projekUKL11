<x-app-layout>
    <div class="min-h-screen bg-[#f6f7fb] p-8 font-['Plus_Jakarta_Sans'] text-slate-800">
        <div class="max-w-6xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-black text-slate-900">Daftar Kas / Organisasi</h1>
                    <p class="text-sm text-slate-500 mt-1">Informasi organisasi yang tersedia untuk transaksi.</p>
                </div>
                @if(in_array(Auth::user()->role, ['super_admin', 'bendahara']))
                    <a href="{{ route('dashboard') }}" class="h-[44px] px-4 rounded-2xl bg-[#ea6b6b] text-white text-sm font-bold hover:bg-[#df5f5f] transition-all">Buat Kas</a>
                @endif
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700 font-bold">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($kasOrganisasis as $organisasi)
                    <article class="rounded-[28px] border border-slate-100 bg-white p-6 shadow-sm">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-[11px] uppercase tracking-[0.25em] text-slate-400 font-black">Kode Kelas</p>
                                <h2 class="text-xl font-black text-slate-800 mt-2">{{ $organisasi->kode_kelas }}</h2>
                            </div>
                            <span class="rounded-full bg-red-50 text-[#ea6b6b] text-[11px] font-black px-3 py-1">{{ ucfirst($organisasi->periode_iuran) }}</span>
                        </div>
                        <p class="mt-4 text-lg font-black text-slate-900">{{ $organisasi->nama_organisasi }}</p>
                        <dl class="mt-6 grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <dt class="text-slate-400 text-xs uppercase tracking-widest">Nominal Iuran</dt>
                                <dd class="mt-1 font-black text-slate-800">Rp {{ number_format($organisasi->nominal_iuran, 0, ',', '.') }}</dd>
                            </div>
                            <div>
                                <dt class="text-slate-400 text-xs uppercase tracking-widest">Saldo</dt>
                                <dd class="mt-1 font-black text-slate-800">Rp {{ number_format($organisasi->saldo, 0, ',', '.') }}</dd>
                            </div>
                        </dl>
                        <p class="text-[11px] text-slate-400 mt-4">Dibuat oleh: {{ $organisasi->user->name ?? '-' }}</p>
                    </article>
                @empty
                    <div class="md:col-span-2 xl:col-span-3 rounded-[28px] border border-dashed border-slate-200 bg-slate-50 p-8 text-center text-slate-500">Belum ada kas/organisasi yang dibuat.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
