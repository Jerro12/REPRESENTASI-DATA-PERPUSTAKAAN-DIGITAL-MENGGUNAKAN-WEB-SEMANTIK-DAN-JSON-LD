<x-admin title="Data Siswa">
    <div class="p-8 animate-fade-in">
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-foreground">Data Siswa</h1>
                <p class="text-muted-foreground mt-1">Kelola master data siswa perpustakaan</p>
            </div>
            <div class="flex gap-3">
                <button onclick="document.getElementById('importModal').classList.remove('hidden')" class="px-4 py-2 bg-secondary text-foreground font-semibold rounded-xl hover:bg-secondary/80 transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    Import Excel
                </button>
                <a href="{{ route('admin.students.create') }}" class="px-4 py-2 bg-primary text-primary-foreground font-semibold rounded-xl hover:bg-primary/90 transition-colors flex items-center gap-2 shadow-lg shadow-primary/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Siswa
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-card border border-border rounded-xl shadow-sm">
            <div class="p-6 border-b border-border">
                <form action="{{ route('admin.students.index') }}" method="GET" class="relative max-w-md">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari NIS atau Nama..." class="w-full pl-10 pr-4 py-2 bg-secondary/50 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 text-foreground">
                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-secondary/30">
                            <th class="text-left px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">NIS</th>
                            <th class="text-left px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Nama Siswa</th>
                            <th class="text-left px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Tempat, Tgl Lahir</th>
                            <th class="text-left px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Alamat</th>
                            <th class="text-right px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse($students as $student)
                            <tr class="hover:bg-secondary/20 transition-colors">
                                <td class="px-6 py-4 font-mono text-sm text-foreground">{{ $student->nis }}</td>
                                <td class="px-6 py-4 font-medium text-foreground">{{ $student->nama }}</td>
                                <td class="px-6 py-4 text-sm text-muted-foreground">
                                    {{ $student->tempat_lahir ?? '-' }}, {{ $student->tanggal_lahir ? date('d-m-Y', strtotime($student->tanggal_lahir)) : '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-muted-foreground">{{ $student->alamat ?? '-' }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.students.edit', $student) }}" class="p-2 text-blue-500 hover:bg-blue-500/10 rounded-lg transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-500 hover:bg-red-500/10 rounded-lg transition-colors" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-muted-foreground">Belum ada data siswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-border">
                {{ $students->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div id="importModal" class="fixed inset-0 z-[100] hidden">
        <div class="fixed inset-0 bg-background/80 backdrop-blur-sm" onclick="document.getElementById('importModal').classList.add('hidden')"></div>
        <div class="fixed left-[50%] top-[50%] z-50 grid w-full max-w-lg translate-x-[-50%] translate-y-[-50%] gap-4 border border-border bg-card p-6 shadow-lg sm:rounded-lg">
            <h2 class="text-lg font-semibold text-foreground">Import Data Siswa</h2>
            <form action="{{ route('admin.students.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="space-y-4">
                    <p class="text-sm text-muted-foreground">Upload file Excel (.xlsx atau .csv) yang berisi master data siswa.</p>
                    <div class="p-4 bg-secondary/50 rounded-lg border border-border/50">
                        <p class="text-xs font-semibold mb-2">Penting:</p>
                        <p class="text-xs text-muted-foreground mb-3">Pastikan file memiliki heading (baris pertama) persis seperti template agar tidak terjadi error.</p>
                        <a href="{{ route('admin.students.export_template') }}" class="inline-flex items-center gap-1.5 text-xs text-primary hover:underline font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Download Template Excel
                        </a>
                    </div>
                    <input type="file" name="file" required accept=".xlsx,.xls,.csv" class="w-full px-3 py-2 border border-border rounded-md bg-secondary/50 text-foreground text-sm">
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="px-4 py-2 border border-border rounded-lg hover:bg-secondary transition-colors text-sm font-medium">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors text-sm font-medium">Upload & Import</button>
                </div>
            </form>
        </div>
    </div>
</x-admin>
