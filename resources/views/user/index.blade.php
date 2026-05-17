<x-app-layout>
    <div class="font-['Plus_Jakarta_Sans'] text-slate-800">
        <div class="w-full bg-white border-b border-slate-200 px-12 py-5 mb-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2 text-sm">
                    <span class="text-slate-400">Dashboard</span>
                    <span class="text-slate-300">/</span>
                    <span class="font-semibold text-slate-800">Manajemen Pengguna</span>
                </div>
            </div>
        </div>

        <div class="px-12 pb-12">
            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-8 gap-4">
                <div class="block">
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Daftar Anggota Kelas</h1>
                    <p class="text-slate-500 mt-1 text-sm">Kelola hak akses pengguna sistem Kas Digital XI SIJA 1.</p>
                </div>
                
                <div class="flex items-center gap-3 self-start lg:self-auto flex-shrink-0">
                    @if(!Auth::user()->role || Auth::user()->role == 'admin')
                    <button onclick="toggleUserModal(true)" class="flex items-center gap-2 bg-[#a03e40] hover:bg-[#893537] text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-red-900/10 transition-all text-sm h-fit">
                        <span class="material-symbols-outlined text-lg">person_add</span>
                        Tambah User
                    </button>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="relative w-full md:w-96">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400 text-xl">search</span>
                        <input type="text" placeholder="Cari anggota..." class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-200 focus:border-[#a03e40] outline-none transition-all">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-[11px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                                <th class="px-8 py-4">Nama Siswa</th>
                                <th class="px-8 py-4">Email</th>
                                <th class="px-8 py-4">Role / Hak Akses</th>
                                <th class="px-8 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-5 font-bold text-slate-800">Fathizzat Abida R.</td>
                                <td class="px-8 py-5 text-slate-500">fathizzat@skomda.sch.id</td>
                                <td class="px-8 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[11px] font-bold uppercase bg-red-50 text-[#a03e40] border border-red-100">
                                        Admin
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex justify-center gap-2">
                                        <button class="p-2 text-slate-400 hover:text-[#a03e40] hover:bg-red-50 rounded-lg transition-all">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </button>
                                        <button class="p-2 text-slate-400 hover:text-[#a03e40] hover:bg-red-50 rounded-lg transition-all">
                                            <span class="material-symbols-outlined text-xl">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="userModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-2xl w-[28rem] shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="px-6 py-5 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-extrabold text-slate-800">Tambah Anggota Baru</h3>
                <button onclick="toggleUserModal(false)" class="text-slate-400 hover:text-slate-600 flex">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form action="#" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Alamat Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Hak Akses (Role)</label>
                    <select name="role" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                        <option value="siswa">Siswa (View Only)</option>
                        <option value="bendahara">Bendahara</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Password Sementara</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#a03e40] outline-none transition-all">
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="toggleUserModal(false)" class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition-all text-sm">Batal</button>
                    <button type="submit" class="flex-1 py-3 bg-[#a03e40] hover:bg-[#893537] text-white rounded-xl font-bold transition-all text-sm shadow-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleUserModal(show) {
            const modal = document.getElementById('userModal');
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
</x-app-layout>