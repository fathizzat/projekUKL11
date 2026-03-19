<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-tight">Daftar Akun Baru</h2>
        <p class="text-gray-500 text-sm">Silakan isi data untuk bergabung</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nama Lengkap" class="text-gray-700 font-semibold" />
            <x-text-input id="name" 
                class="block mt-1 w-full !bg-white !text-gray-900 border-gray-300 focus:border-[#D65A5A] focus:ring-[#D65A5A] rounded-lg shadow-sm" 
                type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email" class="text-gray-700 font-semibold" />
            <x-text-input id="email" 
                class="block mt-1 w-full !bg-white !text-gray-900 border-gray-300 focus:border-[#D65A5A] focus:ring-[#D65A5A] rounded-lg shadow-sm" 
                type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" class="text-gray-700 font-semibold" />
            <x-text-input id="password" 
                class="block mt-1 w-full !bg-white !text-gray-900 border-gray-300 focus:border-[#D65A5A] focus:ring-[#D65A5A] rounded-lg shadow-sm" 
                type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-gray-700 font-semibold" />
            <x-text-input id="password_confirmation" 
                class="block mt-1 w-full !bg-white !text-gray-900 border-gray-300 focus:border-[#D65A5A] focus:ring-[#D65A5A] rounded-lg shadow-sm" 
                type="password" name="password_confirmation" required />
        </div>

        <div class="mt-8">
            <button class="w-full bg-[#22C55E] hover:bg-green-600 text-white font-bold py-3 px-4 rounded-xl transition duration-200 shadow-lg active:scale-95">
                DAFTAR SEKARANG
            </button>
        </div>

        <div class="mt-4 text-center">
            <a class="text-sm text-gray-600 hover:text-[#D65A5A] transition underline decoration-[#D65A5A]/30" href="{{ route('login') }}">
                Sudah punya akun? Login di sini
            </a>
        </div>
    </form>
</x-guest-layout>