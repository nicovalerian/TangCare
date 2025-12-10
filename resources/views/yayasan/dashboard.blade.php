<x-layouts.app title="Yayasan Dashboard - TangCare">
    <livewire:navbar />

    <div class="min-h-screen bg-muted py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="bg-secondary rounded-lg p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="inline-block px-3 py-1 bg-white/20 text-white text-sm font-semibold rounded-full mb-3 uppercase tracking-wider">Yayasan</span>
                        <h1 class="text-3xl font-extrabold text-white mb-2">
                            Welcome, {{ auth()->user()->name }}!
                        </h1>
                        <p class="text-white/80">
                            Manage your foundation's events and donations.
                        </p>
                    </div>
                    <div class="hidden sm:block">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-secondary">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-foreground">0</p>
                            <p class="text-sm text-gray-600">Active Events</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-foreground">0</p>
                            <p class="text-sm text-gray-600">Donations Received</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-foreground">0</p>
                            <p class="text-sm text-gray-600">Pending Review</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Coming Soon -->
            <div class="bg-white rounded-lg p-8 text-center">
                <div class="w-16 h-16 bg-muted rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-foreground mb-2">Yayasan Features Coming Soon</h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    Event creation, donation management, and approval workflow features are in development!
                </p>
            </div>
        </div>
    </div>
</x-layouts.app>
