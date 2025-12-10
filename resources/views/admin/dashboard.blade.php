<x-layouts.app title="Admin Dashboard - TangCare">
    <livewire:navbar />

    <div class="min-h-screen bg-muted py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $pendingYayasans = \App\Models\Yayasan::whereNull('verified_at')->count();
            @endphp
            
            <!-- Welcome Header -->
            <div class="bg-gray-900 rounded-lg p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="inline-block px-3 py-1 bg-primary text-white text-sm font-semibold rounded-full mb-3 uppercase tracking-wider">Admin</span>
                        <h1 class="text-3xl font-extrabold text-white mb-2">
                            Admin Dashboard
                        </h1>
                        <p class="text-gray-400">
                            Manage users, yayasans, and platform settings.
                        </p>
                    </div>
                    <div class="hidden sm:block">
                        <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-white">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pending Yayasans Alert -->
            @if($pendingYayasans > 0)
                <a href="{{ route('admin.yayasans') }}?status=pending" class="block bg-accent/10 border-2 border-accent rounded-lg p-4 mb-8 hover:bg-accent/20 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-foreground">{{ $pendingYayasans }} Yayasan{{ $pendingYayasans > 1 ? 's' : '' }} Pending Verification</p>
                            <p class="text-sm text-gray-600">Click to review and verify foundation accounts</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
            @endif
            
            <!-- Quick Actions -->
            <div class="grid md:grid-cols-2 gap-4 mb-8">
                <a href="{{ route('admin.yayasans') }}" class="bg-white rounded-lg p-6 flex items-center gap-4 hover:scale-[1.02] transition-transform">
                    <div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-foreground">Manage Yayasans</h3>
                        <p class="text-sm text-gray-500">Verify and manage foundations</p>
                    </div>
                </a>
                <div class="bg-white rounded-lg p-6 flex items-center gap-4 opacity-60 cursor-not-allowed">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-foreground">Manage Users</h3>
                        <p class="text-sm text-gray-500">Coming soon</p>
                    </div>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-foreground">{{ \App\Models\User::count() }}</p>
                            <p class="text-sm text-gray-600">Total Users</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-foreground">{{ \App\Models\Yayasan::count() }}</p>
                            <p class="text-sm text-gray-600">Yayasans</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-foreground">{{ \App\Models\Event::count() }}</p>
                            <p class="text-sm text-gray-600">Events</p>
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
                            <p class="text-2xl font-bold text-foreground">{{ \App\Models\Donation::count() }}</p>
                            <p class="text-sm text-gray-600">Donations</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Platform Stats -->
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg p-6">
                    <h3 class="font-bold text-foreground mb-4">Total Impact</h3>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-primary">
                            {{ number_format(\App\Models\Donation::where('status', 'received')->sum('weight_kg'), 1) }}
                        </span>
                        <span class="text-xl text-gray-500">kg donated</span>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg p-6">
                    <h3 class="font-bold text-foreground mb-4">Donation Status Breakdown</h3>
                    <div class="space-y-2">
                        @php
                            $statusCounts = \App\Models\Donation::selectRaw('status, count(*) as count')->groupBy('status')->pluck('count', 'status');
                        @endphp
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Pending</span>
                            <span class="font-bold text-accent">{{ $statusCounts['pending'] ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Accepted</span>
                            <span class="font-bold text-primary">{{ $statusCounts['accepted'] ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Received</span>
                            <span class="font-bold text-secondary">{{ $statusCounts['received'] ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Rejected</span>
                            <span class="font-bold text-red-600">{{ $statusCounts['rejected'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
