<x-admin title="Tambah Siswa">
    <div class="p-8 animate-fade-in max-w-3xl">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-foreground">Tambah Siswa Baru</h1>
            <p class="text-muted-foreground mt-1">Masukkan data siswa dengan lengkap dan benar.</p>
        </div>

        <div class="bg-card border border-border rounded-xl shadow-sm p-6">
            <form action="{{ route('admin.students.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-foreground">NIS <span class="text-red-500">*</span></label>
                        <input type="text" name="nis" value="{{ old('nis') }}" required class="w-full px-4 py-2 bg-secondary/50 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 text-foreground">
                        @error('nis') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-foreground">Nama Siswa <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full px-4 py-2 bg-secondary/50 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 text-foreground">
                        @error('nama') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-foreground">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full px-4 py-2 bg-secondary/50 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 text-foreground">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-foreground">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full px-4 py-2 bg-secondary/50 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 text-foreground">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-foreground">Nomor Telepon</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp') }}" class="w-full px-4 py-2 bg-secondary/50 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 text-foreground">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-foreground">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" class="w-full px-4 py-2 bg-secondary/50 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 text-foreground">{{ old('alamat') }}</textarea>
                    </div>
                </div>

                <div class="pt-4 border-t border-border flex justify-end gap-3">
                    <a href="{{ route('admin.students.index') }}" class="px-5 py-2.5 border border-border rounded-lg hover:bg-secondary transition-colors text-sm font-medium">Batal</a>
                    <button type="submit" class="px-5 py-2.5 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors text-sm font-medium shadow-lg shadow-primary/20">Simpan Siswa</button>
                </div>
            </form>
        </div>
    </div>
</x-admin>
