<section>
    <header class="space-y-1">
        <p class="text-[11px] uppercase tracking-[0.25em] text-[#ea6b6b] font-black"></p>
        <h2 class="text-xl font-black text-slate-800">
            {{ __('Informasi Akun') }}
        </h2>

        <p class="text-sm text-slate-500">
            {{ __("Perbarui Informasi Akun anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-2xl border border-slate-200 bg-slate-50/90 px-4 py-3 text-slate-700 shadow-sm transition placeholder:text-slate-400 focus:border-[#ea6b6b] focus:bg-white focus:ring-4 focus:ring-[#ea6b6b]/10" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-2xl border border-slate-200 bg-slate-50/90 px-4 py-3 text-slate-700 shadow-sm transition placeholder:text-slate-400 focus:border-[#ea6b6b] focus:bg-white focus:ring-4 focus:ring-[#ea6b6b]/10" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-slate-600">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="rounded-md text-sm font-semibold text-[#a03e40] underline decoration-[#ea6b6b]/40 underline-offset-4 transition hover:text-[#ea6b6b] focus:outline-none focus:ring-2 focus:ring-[#ea6b6b]/20">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
