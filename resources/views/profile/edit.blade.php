<x-app-layout>
    <div class="min-h-screen bg-[#f6f7fb] font-['Plus_Jakarta_Sans']">
        <div class="bg-white border-b border-slate-200 flex items-center justify-between px-6 py-6 lg:px-10 lg:py-7">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-[#ea6b6b] font-black">Pengaturan Akun</p>
                <h1 class="text-2xl lg:text-[28px] font-black text-slate-800 mt-1">Ubah data akun Anda</h1>
                <p class="text-sm text-slate-500 mt-1">Perbarui nama, email, dan kata sandi tanpa meninggalkan halaman ini.</p>
            </div>
            <div class="hidden lg:flex items-center gap-3 rounded-2xl bg-red-50 px-4 py-3 text-[#a03e40] shadow-sm">
                <span class="material-symbols-outlined text-xl">manage_accounts</span>
                <span class="text-sm font-bold">Akun pribadi</span>
            </div>
        </div>

        <div class="p-6 lg:p-8">
            @if(session('status') === 'profile-updated' || session('status') === 'password-updated')
                <div class="mb-6 rounded-[24px] border border-emerald-200 bg-emerald-50 px-6 py-4 text-emerald-700 text-sm font-bold flex items-center gap-3 shadow-sm">
                    <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                    Perubahan akun berhasil disimpan.
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
                <aside class="xl:col-span-4 space-y-6">
                    <div class="rounded-[30px] bg-white border border-slate-100 p-6 shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-3xl bg-red-50 flex items-center justify-center text-[#ea6b6b] shadow-sm">
                                <span class="material-symbols-outlined text-3xl">person</span>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-400 font-black">Profil Anda</p>
                                <h2 class="text-xl font-black text-slate-800 mt-1">{{ Auth::user()->name }}</h2>
                                <p class="text-sm text-slate-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <div class="mt-6 rounded-2xl bg-slate-50 p-4 text-sm text-slate-600 space-y-2">
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-slate-400 font-semibold">Peran</span>
                                <span class="font-black text-slate-800 uppercase">{{ Auth::user()->role }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-slate-400 font-semibold">Status</span>
                                <span class="rounded-full bg-emerald-100 text-emerald-700 px-2.5 py-1 text-[11px] font-black uppercase">Aktif</span>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[30px] bg-gradient-to-br from-[#a03e40] via-[#d45f60] to-[#ea6b6b] p-6 text-white shadow-sm">
                        <p class="text-xs uppercase tracking-[0.25em] text-white/80 font-black">Tips</p>
                        <h3 class="text-xl font-black mt-2">Jaga akun tetap aman</h3>
                        <p class="text-sm text-white/90 mt-3">Gunakan email yang aktif dan kata sandi yang kuat agar akun Anda tetap aman saat digunakan.</p>
                    </div>
                </aside>

                <section class="xl:col-span-8 space-y-5">
                    <div class="rounded-[30px] bg-white border border-slate-100 p-6 lg:p-7 shadow-sm">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <div class="rounded-[30px] bg-white border border-slate-100 p-6 lg:p-7 shadow-sm">
                        @include('profile.partials.update-password-form')
                    </div>

                    <div class="rounded-[30px] bg-white border border-slate-100 p-6 lg:p-7 shadow-sm">
                        @include('profile.partials.delete-user-form')
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
