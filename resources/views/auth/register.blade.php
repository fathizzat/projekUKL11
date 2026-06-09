<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Kas Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 flex items-center justify-center p-4">
    <div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-xl border border-slate-200">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-extrabold text-slate-900">Buat Akun</h2>
            <p class="text-sm text-slate-500 mt-1">Pilih role Anda saat daftar</p>
        </div>

        @if ($errors->any())
            <script>
                window.addEventListener('DOMContentLoaded', function () {
                    alert(@json($errors->all()));
                });
            </script>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#a03e40] focus:ring-2 focus:ring-red-100">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#a03e40] focus:ring-2 focus:ring-red-100">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">Role</label>
                <select name="role" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#a03e40] focus:ring-2 focus:ring-red-100">
                    <option value="anggota" {{ old('role') === 'anggota' ? 'selected' : '' }}>Anggota</option>
                    <option value="bendahara" {{ old('role') === 'bendahara' ? 'selected' : '' }}>Bendahara</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">Password</label>
                <input type="password" name="password" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#a03e40] focus:ring-2 focus:ring-red-100">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#a03e40] focus:ring-2 focus:ring-red-100">
            </div>
            <button type="submit" class="w-full rounded-2xl bg-[#a03e40] py-3.5 text-sm font-bold text-white shadow-lg shadow-red-900/10 hover:bg-[#893537]">Daftar</button>
        </form>

        <p class="mt-6 text-center text-xs text-slate-500">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-[#a03e40] hover:underline">Login di sini</a></p>
    </div>
</body>
</html>
