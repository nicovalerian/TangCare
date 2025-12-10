<x-layouts.app title="Dashboard - TangCare">
    <!-- Navbar -->
    <livewire:navbar />

    <div class="min-h-screen bg-muted py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="bg-white rounded-lg p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-extrabold text-foreground mb-2">
                            Welcome back, {{ auth()->user()->name }}!
                        </h1>
                        <p class="text-gray-600">
                            @if(auth()->user()->isDonor())
                                You're making a difference as a donor in Tangerang.
                            @elseif(auth()->user()->isYayasan())
                                Manage your foundation's events and donations.
                            @else
                                Admin Dashboard - Manage the platform.
                            @endif
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
            
            <!-- Stats Cards -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-foreground">{{ number_format(auth()->user()->total_donated_kg, 1) }} kg</p>
                            <p class="text-sm text-gray-600">Total Donated</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-foreground">{{ auth()->user()->donations()->count() }}</p>
                            <p class="text-sm text-gray-600">Donations Made</p>
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
                            <p class="text-2xl font-bold text-foreground">
                                {{ auth()->user()->donations()->where('status', 'pending')->count() }}
                            </p>
                            <p class="text-sm text-gray-600">Pending</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg p-8">
                <h3 class="text-xl font-bold text-foreground mb-6">Quick Actions</h3>
                <div class="grid sm:grid-cols-2 gap-4">
                    <a href="{{ route('events.map') }}" class="group p-6 bg-muted rounded-lg hover:bg-primary/10 transition-all hover:scale-[1.02]">
                        <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mb-4 transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <p class="font-bold text-foreground mb-1">Find Events</p>
                        <p class="text-sm text-gray-600">Discover donation events near you</p>
                    </a>
                    <a href="{{ route('donations.create') }}" class="group p-6 bg-muted rounded-lg hover:bg-secondary/10 transition-all hover:scale-[1.02]">
                        <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center mb-4 transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <p class="font-bold text-foreground mb-1">Make a Donation</p>
                        <p class="text-sm text-gray-600">Donate to a foundation</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
