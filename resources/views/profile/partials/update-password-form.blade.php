<section>
    <header class="space-y-1">
        <p class="text-[11px] uppercase tracking-[0.25em] text-[#ea6b6b] font-black"></p>
        <h2 class="text-xl font-black text-slate-800">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            {{ __('Pastikan menggunakan password yang kuat dan unik.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full rounded-2xl border border-slate-200 bg-slate-50/90 px-4 py-3 text-slate-700 shadow-sm transition placeholder:text-slate-400 focus:border-[#ea6b6b] focus:bg-white focus:ring-4 focus:ring-[#ea6b6b]/10" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full rounded-2xl border border-slate-200 bg-slate-50/90 px-4 py-3 text-slate-700 shadow-sm transition placeholder:text-slate-400 focus:border-[#ea6b6b] focus:bg-white focus:ring-4 focus:ring-[#ea6b6b]/10" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-2xl border border-slate-200 bg-slate-50/90 px-4 py-3 text-slate-700 shadow-sm transition placeholder:text-slate-400 focus:border-[#ea6b6b] focus:bg-white focus:ring-4 focus:ring-[#ea6b6b]/10" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
