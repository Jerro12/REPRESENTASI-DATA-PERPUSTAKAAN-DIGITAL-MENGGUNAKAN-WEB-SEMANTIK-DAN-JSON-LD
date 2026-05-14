<x-guest-layout>
    <x-navbar />

    <div class="hero-gradient text-white py-12 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 pointer-events-none" 
             style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.2\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')">
        </div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <h1 class="text-4xl font-black tracking-tight mb-2">Pengaturan Profil</h1>
            <p class="text-lg text-white/70 font-medium">Kelola informasi akun dan keamanan data Anda</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 -mt-8 relative z-20 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Navigation Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-card border border-border rounded-[2.5rem] p-4 shadow-sm sticky top-24">
                    <nav class="space-y-1">
                        <a href="#profile-info" class="flex items-center gap-4 px-6 py-4 rounded-2xl bg-primary/10 text-primary font-black text-sm transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Informasi Profil
                        </a>
                        <a href="#update-password" class="flex items-center gap-4 px-6 py-4 rounded-2xl text-muted-foreground hover:bg-secondary font-bold text-sm transition-all group">
                            <svg class="w-5 h-5 group-hover:text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Ubah Password
                        </a>
                        <a href="#delete-account" class="flex items-center gap-4 px-6 py-4 rounded-2xl text-rose-500 hover:bg-rose-500/10 font-bold text-sm transition-all group">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus Akun
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Content Area -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Update Profile Information -->
                <div id="profile-info" class="bg-card border border-border rounded-[2.5rem] p-8 md:p-12 shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div id="update-password" class="bg-card border border-border rounded-[2.5rem] p-8 md:p-12 shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete User -->
                <div id="delete-account" class="bg-card border border-rose-500/20 rounded-[2.5rem] p-8 md:p-12 shadow-sm bg-rose-500/[0.02]">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>