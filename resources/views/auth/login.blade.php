<x-guest-layout>
    <!-- Menggunakan class bg-auth-gradient yang akan kita buat di CSS -->
<div class="auth-google-layout min-h-screen flex items-center justify-center bg-auth-gradient py-10">
        <div id="container">
            <!-- Login Form -->
            <div class="form-container login-form">
                <form method="POST" action="{{ route('login') }}" class="w-full h-full p-10 flex flex-col items-center justify-center">
                    @csrf
                    <h1 class="font-bold text-3xl mb-5 text-gray-800">Log In</h1>
                    <x-input-error :messages="$errors->get('email')" class="mb-2" />
                    <input type="email" name="email" placeholder="Email" class="input-style" required autofocus />
                    <input type="password" name="password" placeholder="Password" class="input-style" required />
                    <button type="submit" class="btn-main">Log In</button>
                    <p class="text-xs text-gray-400 mt-5">© 2026 Kas Digital</p>
                </form>
            </div>

            <!-- Register Form -->
            <div class="form-container register-form">
                <form method="POST" action="{{ route('register') }}" class="w-full h-full p-10 flex flex-col items-center justify-center">
                    @csrf
                    <h1 class="font-bold text-3xl mb-5 text-gray-800">Sign Up</h1>
                    <input type="text" name="name" placeholder="Nama Lengkap" class="input-style" required />
                    <input type="email" name="email" placeholder="Email" class="input-style" required />
                    <input type="password" name="password" placeholder="Password" class="input-style" required />
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi" class="input-style" required />
                    <button type="submit" class="btn-main">Register</button>
                </form>
            </div>

            <!-- Overlay -->
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-right">
                        <i class="fa-solid fa-user-plus text-5xl mb-4 text-white"></i>
                        <h1 class="text-white text-2xl font-bold">Halo, Teman!</h1>
                        <p class="my-6 text-white">Belum punya akun? Daftar sekarang.</p>
                        <button type="button" class="btn-outline" id="toRegister">REGISTER</button>
                    </div>
                    <div class="overlay-panel overlay-left">
                        <i class="fa-solid fa-right-to-bracket text-5xl mb-4 text-white"></i>
                        <h1 class="text-white text-2xl font-bold">Selamat Datang!</h1>
                        <p class="my-6 text-white">Sudah punya akun? Silakan masuk.</p>
                        <button type="button" class="btn-outline" id="toLogin">LOG IN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        document.getElementById('toRegister').onclick = () => container.classList.add("active");
        document.getElementById('toLogin').onclick = () => container.classList.remove("active");
    </script>
</x-guest-layout>