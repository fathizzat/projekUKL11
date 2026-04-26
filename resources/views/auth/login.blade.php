<x-guest-layout>
    <div id="container" class="relative">
        <div class="form-container login-form">
            <form method="POST" action="{{ route('login') }}" class="w-full p-10">
                @csrf
                <h1 class="font-bold text-3xl mb-5 text-gray-800">Log In</h1>
                <input type="email" name="email" placeholder="Email" class="input-style" required />
                <input type="password" name="password" placeholder="Password" class="input-style" required />
                <button type="submit" class="btn-main">Log In</button>
                <p class="text-xs text-gray-400 mt-5">© 2026 Kas Digital</p>
            </form>
        </div>

        <div class="form-container register-form">
            <form method="POST" action="{{ route('register') }}" class="w-full p-10">
                @csrf
                <h1 class="font-bold text-3xl mb-5 text-gray-800">Sign Up</h1>
                <input type="text" name="name" placeholder="Nama Lengkap" class="input-style" required />
                <input type="email" name="email" placeholder="Email" class="input-style" required />
                <input type="password" name="password" placeholder="Password" class="input-style" required />
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="input-style" required />
                <button type="submit" class="btn-main !bg-green-500">Register</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <i class="fa-solid fa-user-plus text-5xl mb-4"></i>
                    <h1 class="text-white text-2xl font-bold">Halo, Teman!</h1>
                    <p class="my-6">Belum punya akun? Daftar untuk kelola kas kelas.</p>
                    <button class="btn-outline" id="toRegister">REGISTER <i class="fa-solid fa-arrow-right ml-2"></i></button>
                </div>
                <div class="overlay-panel overlay-left">
                    <i class="fa-solid fa-right-to-bracket text-5xl mb-4"></i>
                    <h1 class="text-white text-2xl font-bold">Selamat Datang!</h1>
                    <p class="my-6">Sudah punya akun? Silakan masuk kembali.</p>
                    <button class="btn-outline" id="toLogin"><i class="fa-solid fa-arrow-left mr-2"></i> LOG IN</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const toRegister = document.getElementById('toRegister');
        const toLogin = document.getElementById('toLogin');
        const container = document.getElementById('container');

        toRegister.addEventListener('click', () => container.classList.add("active"));
        toLogin.addEventListener('click', () => container.classList.remove("active"));
    </script>
</x-guest-layout>