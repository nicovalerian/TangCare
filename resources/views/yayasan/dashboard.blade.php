<x-layouts.app title="Yayasan Dashboard - TangCare">
    <livewire:navbar />

    <div class="min-h-screen bg-muted py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $yayasan = auth()->user()->yayasan;
            @endphp
            
            <!-- Welcome Header -->
            <div class="bg-secondary rounded-lg p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        @if($yayasan)
                            @if($yayasan->isVerified())
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-white/20 text-white text-sm font-semibold rounded-full mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Verified
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-accent text-white text-sm font-semibold rounded-full mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Pending Verification
                                </span>
                            @endif
                            <h1 class="text-3xl font-extrabold text-white mb-2">
                                {{ $yayasan->name }}
                            </h1>
                        @else
                            <span class="inline-block px-3 py-1 bg-white/20 text-white text-sm font-semibold rounded-full mb-3 uppercase tracking-wider">Setup Required</span>
                            <h1 class="text-3xl font-extrabold text-white mb-2">
                                Welcome, {{ auth()->user()->name }}!
                            </h1>
                        @endif
                        <p class="text-white/80">
                            @if($yayasan)
                                Manage your foundation's events and donations.
                            @else
                                Complete your foundation profile to get started.
                            @endif
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
            
            @if(!$yayasan)
                <!-- Setup Profile Prompt -->
                <div class="bg-white rounded-lg p-8 text-center">
                    <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-2">Complete Your Profile</h3>
                    <p class="text-gray-600 max-w-md mx-auto mb-6">
                        You need to set up your foundation profile before you can create events and receive donations.
                    </p>
                    <a href="{{ route('yayasan.profile') }}" class="btn-primary inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Setup Profile
                    </a>
                </div>
            @else
                <!-- Quick Actions -->
                <div class="grid md:grid-cols-2 gap-4 mb-8">
                    <a href="{{ route('yayasan.profile') }}" class="bg-white rounded-lg p-6 flex items-center gap-4 hover:scale-[1.02] transition-transform">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-foreground">Foundation Profile</h3>
                            <p class="text-sm text-gray-500">Edit name, address, and location</p>
                        </div>
                    </a>
                    <a href="{{ route('yayasan.events') }}" class="bg-white rounded-lg p-6 flex items-center gap-4 hover:scale-[1.02] transition-transform">
                        <div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-foreground">Manage Events</h3>
                            <p class="text-sm text-gray-500">Create and manage donation events</p>
                        </div>
                    </a>
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
                                <p class="text-2xl font-bold text-foreground">{{ $yayasan->events()->where('is_active', true)->count() }}</p>
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
                                <p class="text-2xl font-bold text-foreground">{{ number_format($yayasan->total_received_kg, 1) }} kg</p>
                                <p class="text-sm text-gray-600">Total Received</p>
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
                                    {{ $yayasan->donations()->where('status', 'pending')->count() }}
                                </p>
                                <p class="text-sm text-gray-600">Pending Review</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Donations -->
                <div class="bg-white rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h2 class="text-lg font-bold text-foreground">Recent Donations</h2>
                    </div>
                    @php
                        $recentDonations = $yayasan->donations()->with(['user', 'event'])->latest()->take(5)->get();
                    @endphp
                    @if($recentDonations->count() > 0)
                        <div class="divide-y divide-gray-100">
                            @foreach($recentDonations as $donation)
                                <div class="px-6 py-4 flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-foreground">{{ $donation->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $donation->event->title }} • {{ $donation->weight_kg }} kg</p>
                                    </div>
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                                        @if($donation->status === 'received') bg-secondary/10 text-secondary
                                        @elseif($donation->status === 'accepted') bg-primary/10 text-primary
                                        @elseif($donation->status === 'rejected') bg-red-100 text-red-600
                                        @else bg-accent/10 text-accent
                                        @endif
                                    ">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="px-6 py-12 text-center text-gray-500">
                            No donations yet. Once donors contribute to your events, they'll appear here.
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
