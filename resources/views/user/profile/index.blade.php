<x-guest-layout>
    <x-navbar />

    <div class="hero-gradient text-white py-12 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 pointer-events-none" 
             style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.2\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')">
        </div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="relative">
                    <div class="w-32 h-32 rounded-[2rem] bg-white/20 backdrop-blur-xl flex items-center justify-center border border-white/30 shadow-2xl overflow-hidden group">
                        <span class="text-5xl font-black text-white group-hover:scale-110 transition-transform duration-500">
                            {{ substr($user->name, 0, 1) }}
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-tr from-primary/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-emerald-500 rounded-2xl border-4 border-primary flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-4xl font-black tracking-tight mb-2">{{ $user->name }}</h1>
                    <p class="text-lg text-white/70 font-medium mb-4">{{ $user->email }} • NIS: {{ $user->nis ?? '-' }}</p>
                    <div class="flex flex-wrap justify-center md:justify-start gap-3">
                        <a href="{{ route('profile.edit') }}" class="px-6 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Pengaturan Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 -mt-8 relative z-20 pb-24">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-card border border-border p-8 rounded-[2.5rem] shadow-xl shadow-black/5 group hover:border-primary/50 transition-all duration-500">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 rounded-3xl bg-primary/10 flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-muted-foreground opacity-60 mb-1">Total Peminjaman</p>
                        <h3 class="text-3xl font-black text-foreground">{{ $stats['total'] }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-card border border-border p-8 rounded-[2.5rem] shadow-xl shadow-black/5 group hover:border-accent/50 transition-all duration-500">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 rounded-3xl bg-accent/10 flex items-center justify-center text-accent group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-muted-foreground opacity-60 mb-1">Sedang Dipinjam</p>
                        <h3 class="text-3xl font-black text-foreground">{{ $stats['active'] }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-card border border-border p-8 rounded-[2.5rem] shadow-xl shadow-black/5 group hover:border-emerald-500/50 transition-all duration-500">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 rounded-3xl bg-emerald-500/10 flex items-center justify-center text-emerald-500 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-muted-foreground opacity-60 mb-1">Telah Dikembalikan</p>
                        <h3 class="text-3xl font-black text-foreground">{{ $stats['returned'] }}</h3>
                    </div>
                </div>
            </div>
        </div>        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
            <!-- Sidebar Info -->
            <div class="xl:col-span-1 space-y-6">
                <div class="bg-card border border-border rounded-[2.5rem] p-8 shadow-sm">
                    <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-primary mb-6 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        Informasi Akun
                    </h3>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-secondary flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-50 mb-0.5">Nama Lengkap</p>
                                <p class="text-sm font-bold text-foreground">{{ $user->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-secondary flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-50 mb-0.5">Email</p>
                                <p class="text-sm font-bold text-foreground">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-secondary flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-50 mb-0.5">Nomor Induk Siswa (NIS)</p>
                                <p class="text-sm font-bold text-foreground">{{ $user->nis ?? 'Belum Diatur' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-secondary flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-50 mb-0.5">Tanggal Bergabung</p>
                                <p class="text-sm font-bold text-foreground">{{ $user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- History Main -->
            <div class="xl:col-span-3">
                <div class="bg-card border border-border rounded-[2.5rem] shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-border bg-secondary/30 flex items-center justify-between">
                        <h3 class="text-xl font-black text-foreground">Riwayat Peminjaman</h3>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                            <span class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-60">Status Real-time</span>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto overflow-y-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-secondary/10">
                                    <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-50">Buku</th>
                                    <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-50">Tgl Pinjam</th>
                                    <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-50">Tgl Kembali</th>
                                    <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-50 text-center">Status</th>
                                    <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-50 text-center">Denda</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border/50">
                                @forelse($borrowings as $borrowing)
                                    <tr class="hover:bg-secondary/20 transition-colors group">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-14 rounded-lg bg-secondary shrink-0 overflow-hidden shadow-sm group-hover:scale-105 transition-transform duration-500">
                                                    @if($borrowing->book?->cover)
                                                        <img src="{{ asset('storage/' . $borrowing->book->cover) }}" alt="" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center">
                                                            <svg class="w-5 h-5 text-muted-foreground/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" stroke-width="2"/></svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="font-black text-sm text-foreground mb-0.5 line-clamp-1 max-w-[150px] md:max-w-[200px]">{{ $borrowing->book?->judul ?? 'Buku Terhapus' }}</p>
                                                    <p class="text-xs text-muted-foreground opacity-60">{{ $borrowing->book?->penulis ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <span class="text-sm font-bold text-foreground/80 whitespace-nowrap">{{ $borrowing->borrow_date->format('d M Y') }}</span>
                                        </td>
                                        <td class="px-6 py-5">
                                            <span class="text-sm font-bold text-foreground/80 whitespace-nowrap">{{ $borrowing->due_date->format('d M Y') }}</span>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-amber-500/10 text-amber-500 ring-amber-500/30',
                                                    'borrowed' => 'bg-blue-500/10 text-blue-500 ring-blue-500/30',
                                                    'returned' => 'bg-emerald-500/10 text-emerald-500 ring-emerald-500/30',
                                                    'overdue' => 'bg-rose-500/10 text-rose-500 ring-rose-500/30',
                                                    'rejected' => 'bg-slate-500/10 text-slate-500 ring-slate-500/30',
                                                ];
                                                $statusLabels = [
                                                    'pending' => 'Menunggu',
                                                    'borrowed' => 'Dipinjam',
                                                    'returned' => 'Kembali',
                                                    'overdue' => 'Terlambat',
                                                    'rejected' => 'Ditolak',
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest ring-1 {{ $statusClasses[$borrowing->status] ?? 'bg-secondary text-muted-foreground ring-border' }}">
                                                {{ $statusLabels[$borrowing->status] ?? $borrowing->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            @php
                                                $denda = $borrowing->denda;
                                                if ($borrowing->status === 'borrowed' && \Carbon\Carbon::now()->startOfDay()->greaterThan(\Carbon\Carbon::parse($borrowing->due_date)->startOfDay())) {
                                                    $lateDays = \Carbon\Carbon::parse($borrowing->due_date)->startOfDay()->diffInDays(\Carbon\Carbon::now()->startOfDay());
                                                    $denda = $lateDays * 2000;
                                                }
                                            @endphp
                                            @if($denda > 0)
                                                <span class="text-sm font-bold text-rose-500">Rp {{ number_format($denda, 0, ',', '.') }}</span>
                                            @else
                                                <span class="text-sm font-bold text-muted-foreground/50">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-8 py-24 text-center">
                                            <div class="w-16 h-16 bg-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-8 h-8 text-muted-foreground/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.247 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="2"/></svg>
                                            </div>
                                            <p class="text-sm font-bold text-muted-foreground opacity-50">Belum ada riwayat peminjaman.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
