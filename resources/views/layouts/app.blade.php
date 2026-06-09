<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Kas Digital') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#f9f9f9]">
    @php
        $kasPilihan = collect();
        if (Auth::check()) {
            $query = \App\Models\KasOrganisasi::query()->with('user')->latest();

            if (Auth::user()->role === 'bendahara' || Auth::user()->role === 'super_admin') {
                $query->where('created_by', Auth::id());
            }

            if (Auth::user()->role === 'anggota') {
                $query->whereHas('anggota', function ($q) {
                    $q->where('user_id', Auth::id())
                      ->where('status', 'accepted');
                });
            }

            $kasPilihan = $query->get();
        }
    @endphp
    <div class="min-h-screen flex">
        @include('layouts.navigation')

        <div class="flex-1 pl-72 w-full overflow-hidden">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- GLOBAL MODAL PILIH KAS -->
    <div id="pilihKasGlobalModal" class="fixed inset-0 bg-black/50 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-[30px] w-[24rem] shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-[#fffdfd]">
                <h3 class="font-extrabold text-slate-800 text-lg">Pilih Kas</h3>
                <button onclick="togglePilihKasGlobalModal(false)" class="text-slate-400 hover:text-[#ea6b6b] transition-colors flex">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-8 space-y-4 relative z-50">
                @forelse($kasPilihan as $kas)
                    <a href="{{ route('organisasi.show', $kas) }}" class="block border-2 border-[#ea6b6b] rounded-2xl p-4 hover:bg-[#fff4f4] transition-colors group cursor-pointer overflow-hidden">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[#ea6b6b]">groups</span>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-slate-800 truncate">{{ $kas->nama_organisasi }}</h4>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ $kas->user->name ?? 'Bendahara' }}</p>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-[#ea6b6b] group-hover:translate-x-1 transition-transform shrink-0">arrow_forward</span>
                        </div>
                    </a>
                @empty
                    <div class="block border-2 border-dashed border-slate-200 rounded-2xl p-4 text-center text-slate-500">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Belum ada kas yang bisa dibuka</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function togglePilihKasGlobalModal(show) {
            const modal = document.getElementById('pilihKasGlobalModal');
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
</body>
</html>