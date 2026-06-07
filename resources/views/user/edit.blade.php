<x-app-layout>
    <div class="font-['Plus_Jakarta_Sans'] text-slate-800">
        <div class="w-full bg-white border-b border-slate-200 px-12 py-5 mb-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2 text-sm">
                    <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-slate-600">Dashboard</a>
                    <span class="text-slate-300">/</span>
                    <a href="{{ route('user.index') }}" class="text-slate-400 hover:text-slate-600">Manajemen Pengguna</a>
                    <span class="text-slate-300">/</span>
                    <span class="font-semibold text-slate-800">Edit User</span>
                </div>
            </div>
        </div>

        <div class="px-12 pb-12">

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl text-sm font-bold">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Edit User</h1>
                <p class="text-slate-500 mt-1 text-sm">Perbarui informasi pengguna. Kosongkan password jika tidak ingin mengubah.</p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 max-w-2xl">
                <form action="{{ route('user.update', $user->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                        <input type="text" name="name" required value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Alamat Email</label>
                        <input type="email" name="email" required value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Hak Akses (Role)</label>
                        <select name="role" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                            <option value="anggota" {{ old('role', $user->role) === 'anggota' ? 'selected' : '' }}>Anggota</option>
                            <option value="bendahara" {{ old('role', $user->role) === 'bendahara' ? 'selected' : '' }}>Bendahara</option>
                            <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Password Baru <span class="normal-case text-slate-300">(kosongkan jika tidak diubah)</span></label>
                        <input type="password" name="password" minlength="6" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all" placeholder="••••••">
                    </div>

                    <div class="pt-4 flex gap-3">
                        <a href="{{ route('user.index') }}" class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition-all text-sm text-center">Batal</a>
                        <button type="submit" class="flex-1 py-3 bg-[#a03e40] hover:bg-[#893537] text-white rounded-xl font-bold transition-all text-sm shadow-md">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
