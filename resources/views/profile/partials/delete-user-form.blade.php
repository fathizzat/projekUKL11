<section class="space-y-6">
    <header class="space-y-1">
        <h2 class="text-xl font-black text-slate-800">
            {{ __('Hapus Akun') }}
        </h2>

    
    </header>

    <div class="rounded-2xl border border-rose-100 bg-rose-50/70 p-4 text-sm text-rose-700">
        Jika Anda ingin menghapus akun, tindakan ini permanen. Pastikan Anda sudah yakin sebelum melanjutkan.
    </div>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Hapus Akun') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-black text-slate-800">
                {{ __('Apakah Anda yakin ingin menghapus akun?') }}
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                {{ __('Setelah akun dihapus, semua data dan akses Anda akan hilang secara permanen. Masukkan kata sandi untuk mengonfirmasi penghapusan akun.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-2xl border border-slate-200 bg-slate-50/90 px-4 py-3 text-slate-700 shadow-sm transition placeholder:text-slate-400 focus:border-[#ea6b6b] focus:bg-white focus:ring-4 focus:ring-[#ea6b6b]/10"
                    placeholder="{{ __('Kata Sandi') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
